<?php
    $document_items = 'false';

    if ($items) {
        $document_items = json_encode($items);
    } else if (old('items')) {
        $document_items = json_encode(old('items'));
    }
?>

<script type="text/javascript">
    var document_items = <?php echo $document_items; ?>;
    var document_default_currency = '<?php echo e($currency_code); ?>';
    var document_currencies = <?php echo $currencies; ?>;
    var document_taxes = <?php echo $taxes; ?>;
</script>

<script src="<?php echo e(asset( $scriptFile . '?v=' . $version)); ?>"></script>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/script.blade.php ENDPATH**/ ?>