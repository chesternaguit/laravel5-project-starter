<?php
/*
|--------------------------------------------------------------------------
| Bootstrap Macros
|--------------------------------------------------------------------------
| A slightly modified macros for faster templating
| Source:
| http://forumsarchive.laravel.io/viewtopic.php?id=11960
|
*/
Form::macro('textField', function($name, $label = null, $value = null, $attributes = array())
{
    $element = Form::text($name, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('taggingField', function($name, $label = null,  $value = null, $attributes = array())
{
    $attributes = $attributes + ['class' => 'selectize-tagging'];

    $element = Form::text($name, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('contactField', function($name, $label = null, $options, $value = null, $attributes = array())
{
    $attributes = $attributes + ['class' => 'selectize-contact', 'multiple'];

    $element = Form::select($name, [null => 'Select One'] + $options, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('dateField', function($name, $label = null, $value = null)
{
    $attributes = ['data' => 'date-picker-input'];
    $element = Form::text($name, $value, fieldAttributes($name, $attributes));

    $out = '<div class="form-group';
    $out .= fieldError($name) . '">';
    $out .= fieldLabel($name, $label);
    $out .= '<div class="input-group">';
    $out .= $element;
    $out .= '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>';
    $out .= '</div>';
    $out .= fieldMsg($name);
    $out .= "</div>";

    return $out;
});

Form::macro('dateRangeField', function($name, $label = null, $value = null, $otherAttributes = array())
{
    $attributes = ['id' => 'dateRangePicker'];
    $result = array_merge($attributes,$otherAttributes);
    $element = Form::text($name, $value, fieldAttributes($name, $result));

    $out = '<div class="form-group';
    $out .= fieldError($name) . '">';
    $out .= fieldLabel($name, $label);
    $out .= '<div class="input-group">';
    $out .= $element;
    $out .= '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>';
    $out .= '</div>';
    $out .= fieldMsg($name);
    $out .= "</div>";

    return $out;
});


Form::macro('dateTimeField', function($name, $label = null, $value = null)
{
    $attributes = ['data' => 'date-time-picker-input', 'data-date-format'=>"YYYY-MM-DD HH:mm:ss"];
    $element = Form::text($name, $value, fieldAttributes($name, $attributes));

    $out = '<div class="form-group';
    $out .= fieldError($name) . '">';
    $out .= fieldLabel($name, $label);
    $out .= '<div class="input-group">';
    $out .= $element;
    $out .= '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>';
    $out .= '</div>';
    $out .= fieldMsg($name);
    $out .= "</div>";

    return $out;
});

Form::macro('timeField', function($name, $label = null, $value = null)
{
    $attributes = ['class' => 'form-control timepicker'];
    $element = Form::text($name, $value, fieldAttributes($name, $attributes));

    $out = '<div class="bootstrap-timepicker"><div class="form-group';
    $out .= fieldError($name) . '">';
    $out .= fieldLabel($name, $label);
    $out .= '<div class="input-group">';
    $out .= $element;
    $out .= '<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>';
    $out .= '</div>';
    $out .= fieldMsg($name);
    $out .= "</div></div>";

    return $out;
});

Form::macro('passwordField', function($name, $label = null, $attributes = array())
{
    $element = Form::password($name, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('textareaField', function($name, $label = null, $value = null, $attributes = array())
{
    $element = Form::textarea($name, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('selectField', function($name, $label = null, $options, $value = null, $attributes = array())
{
    $attributes = $attributes + ['class' => 'selectize'];

    $element = Form::select($name, [null => 'Select One'] + $options, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('selectMultipleField', function($name, $label = null, $options, $value = null, $attributes = array())
{
    $attributes = array_merge($attributes, ['multiple' => true]);
    $element = Form::select($name, $options, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('booleanField', function($name, $label = null, $value = null, $attributes = array())
{
    $attributes = $attributes + ['class' => 'selectize'];

    $element = Form::select($name, [null => 'Select One', 1 => 'Enabled', 0 => 'Disabled'], $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('checkboxField', function($name, $label = null, $value = 1, $checked = null, $attributes = array())
{
    $attributes = array_merge(['id' => 'id-field-' . $name], $attributes);

    $out = '<div class="checkbox';
    $out .= fieldError($name) . '">';
    $out .= '<label>';
    $out .= Form::checkbox($name, $value, $checked, $attributes) . ' ' . $label;
    $out .= '</div>';

    return $out;
});

function fieldWrapper($name, $label, $element)
{
    $out = '<div class="form-group';
    $out .= fieldError($name) . '">';
    $out .= fieldLabel($name, $label);
    $out .= $element;
    $out .= fieldMsg($name);
    $out .= '</div>';

    return $out;
}

function fieldMsg($field)
{
    $error = '';

    if ($errors = Session::get('errors'))
    {
        $error = $errors->first($field) ? $errors->first($field) : '';

        if ($error)
        {
            $error = "<p class=\"help-block\">$error.</p>";
        }
    }

    return $error;
}

function fieldError($field)
{
    $error = '';

    if ($errors = Session::get('errors'))
    {
        $error = $errors->first($field) ? ' has-error' : '';
    }

    return $error;
}

function fieldLabel($name, $label)
{
    if (is_null($label)) return '';

    $name = str_replace('[]', '', $name);

    $out = '<label for="id-field-' . $name . '" class="control-label">';
    $out .= $label . '</label>';

    return $out;
}

function fieldAttributes($name, $attributes = array())
{
    $name = str_replace('[]', '', $name);

    return array_merge(['class' => 'form-control', 'id' => 'id-field-' . $name], $attributes);
}

HTML::macro('placeholder', function($value, $label)
{
    $content = ($value) ? $value : '<span class="label label-default">N/A</span>';
    $out  = '<h4>'. $content .'</h4>';
    $out .= '<span class="text-muted text-uppercase">'.$label.'</span>';

    return $out;
});