<?php $__env->startSection('title', trans_choice('general.invoices', 1) . ': ' . $invoice->invoice_number); ?>
 
<?php $__env->startSection('content'); ?>
<?php if($print_template->attachment): ?>
    <img src="<?php echo e(route('uploads.get' , $print_template->attachment->id)); ?>" id="deleteBeforePrint" />
<?php endif; ?>
    <div class="page">
    <?php
    $invoiceItem=array();
    $invoiceTotal=array();
    $invoiceCustom=array();
    $invoiceCustomField=array();
	
    ?>
    <?php $__currentLoopData = $invoiceprintItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
        <?php
			if (!isset($printItems[$item->item_id])) continue;
            $attr =json_decode($item->attr,true) ;
            $field = $printItems[$item->item_id]["field"];
            $attrname = $printItems[$item->item_id]["name"];
            $display_name = $printItems[$item->item_id]["display_name"];
         
        ?>
        
        <div class="existItem" key="<?php echo e($item->item_id); ?>"  style="position: absolute; <?php $__currentLoopData = $attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemAttr=>$itemValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($itemAttr.":".$itemValue.";"); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
            
            <?php if( $field=="company"): ?>
                <?php echo e($invoice->company->{$attrname}); ?> 
            <?php elseif( $field=="invoice"): ?>
                <?php if(stristr($attrname,"at")): ?>
                 <?php echo company_date($invoice->{$attrname}); ?>
                <?php else: ?>
                <?php echo nl2br($invoice->{$attrname}); ?>

                <?php endif; ?>
                
            <?php elseif( $field=="customer"): ?>
                <?php echo nl2br($invoice->contact->{$attrname}); ?>

            <?php elseif( $field=="item" ): ?>
                <?php 
                    $invoiceItem[$attrname]=$item; 
                ?>  
            <?php elseif( $field=="total"): ?>
                <?php 
                    $invoiceTotal[$attrname]=$item->attr; 
                ?>
            <?php elseif(substr($display_name,0,1)=="_" ): ?>
                <?php
                
                    $invoiceItem["CustomFields"]=$item; 
                ?>
            <?php else: ?>
                <?php 
                    $invoiceCustom[$attrname]=$attr; 
                    $invoiceCustomField[$attrname]=$printItems[$item->item_id];
                    
                ?>
         
            <?php endif; ?>
        
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php
    $itemTop=0;
    $firstLineTop=0;
    $ItemFark=array();
    ?>
    <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php 
            $nextRow=true;
        ?>
        <?php $__currentLoopData = $invoiceItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tempItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($tempItem->attr)): ?>
                <?php
                    $attr =json_decode($tempItem->attr,true);
                    if ($nextRow){
                        if ($itemTop==0){
                            $itemTop=rtrim($attr["top"],"px");
                            $firstLineTop=rtrim($attr["top"],"px");
                        }else{
                            $itemTop+=rtrim($attr["height"],"px");
                        }
                        $nextRow=false;
                    }
                    if (!isset($ItemFark[$key])){
                        //Bazı alanlar diğerlerinden aşağıda olabilir.
                        //bu yüzden bu farkı buluyoruz.
                        $ItemFark[$key]=(rtrim($attr["top"],"px")-$firstLineTop);
                    }
                    $itemTop+=$ItemFark[$key];
                    $attr["top"]=$itemTop."px";
                ?>
                <div class="existItemFatura" style="position: absolute;   <?php $__currentLoopData = $attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemAttr=>$itemValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($itemAttr.":".$itemValue.";"); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>" firstLinetop="<?php echo e($firstLineTop); ?>">
                    <?php if($key=="total" || $key=="price" ): ?>
                        <?php echo money($item->{$key}, $invoice->currency_code, true); ?>
                    <?php elseif($key=="description" ): ?>
                        <?php echo e(Modules\PrintTemplate\Http\Controllers\PrintTemplateController::custom_field("item_description", $item,$date_format,$printItems[$tempItem->item_id])); ?>

                    <?php elseif($key=="CustomFields"): ?>
                        
						 <?php echo Modules\PrintTemplate\Http\Controllers\PrintTemplateController::custom_field("CustomFields", $item,$date_format,$printItems[$tempItem->item_id]); ?> 
						
					<?php else: ?>
                        <?php echo e($item->{$key}); ?>

                    <?php endif; ?>

                </div>
                <?php
                        $itemTop-=$ItemFark[$key];
                    
                ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php
        $taxTop=0;
    ?>
    <?php $__currentLoopData = $invoice->totals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            if (!isset($invoiceTotal[$item->code])) continue;
                    
                 
            $attr = json_decode($invoiceTotal[$item->code],true);
            if ($item->code=="tax"){
                if ($taxTop==0){
                    $taxTop=rtrim($attr["top"],"px");
                }else{
                    $taxTop+=rtrim($attr["height"],"px");
                }
            }else{
                $taxTop=rtrim($attr["top"],"px");
            }
            
            $attr["top"]=$taxTop;
        ?>
        <div class="existItemTotal" style="position: absolute; <?php $__currentLoopData = $attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemAttr=>$itemValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($itemAttr.":".$itemValue.";"); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
                <?php echo money($item->amount, $invoice->currency_code, true); ?>
               
        </div> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = $invoiceCustom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemName=>$attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="existItemTotal" style="position: absolute; <?php $__currentLoopData = $attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemAttr=>$itemValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($itemAttr.":".$itemValue.";"); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
            <?php echo Modules\PrintTemplate\Http\Controllers\PrintTemplateController::custom_field($itemName, $invoice,$date_format,$invoiceCustomField[$itemName]); ?> 
        </div> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<style>
@page{
    margin: 0;
    size: <?php echo e(config("print-template.pageSize-type.".$print_template->pagesize)[0]); ?> <?php echo e(config("print-template.pageSize-type.".$print_template->pagesize)[1]); ?>;
}

.page-break	{ display: block; page-break-before: always; }
.std{
    position:absolute;
}     
html, body, img{
    margin:0;
   
    width:  <?php echo e(config("print-template.pageSize-mm.".$print_template->pagesize)[0]); ?>mm;
    height: <?php echo e(config("print-template.pageSize-mm.".$print_template->pagesize)[1]); ?>mm;
    <?php if(stristr(url()->current(),"pdf")): ?>
    font-family:DejaVu Sans !important;
    <?php endif; ?>
}
img{
    position: absolute;;
}
.page{
    
    margin:0;
    position:relative;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
	<?php if($print_template->printBackground=='false'): ?>
    function onPrint(callback) {
        window.matchMedia('print').addListener(query => query.matches ? callback() : null)
        window.addEventListener('beforeprint', () => callback())
    }

    onPrint(() => {document.getElementById('deleteBeforePrint').style.display='None'})
	<?php endif; ?>
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\PrintTemplate\Providers/../Resources/views/print.blade.php ENDPATH**/ ?>