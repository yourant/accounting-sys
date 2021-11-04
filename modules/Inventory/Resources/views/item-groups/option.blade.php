<tr class="row mb-10">
    @stack('name_td_start')
    <td class="col-md-3">
        @stack('name_input_start')

        {{ Form::selectGroup('option_id', null, 'fas fa-align-justify', $options, null, ['required' => 'required', 'change' => 'getOptionsValue'], 'col-md-12') }}

        @stack('name_input_end')
    </td>
    @stack('name_td_end')

    @stack('value_td_start')
    <td class="col-md-9">
        @stack('value_input_start')
        
          <el-select :disabled="!option_values.length" v-model="form.option_values" @change="onAddOption" multiple @remove-tag="onDeleteOption" placeholder="Select Value">
            <el-option
              v-for="option in option_values"
              :disabled="form.option_values.includes(option.value)"
              :key="option.value"
              :label="option.label"
              :value="option.value">
            </el-option>
          </el-select>

        @stack('value_input_end')
    </td>
    @stack('value_td_end')
</tr>
