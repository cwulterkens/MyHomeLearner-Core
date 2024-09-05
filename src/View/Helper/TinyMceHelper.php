<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper\FormHelper;

class TinyMceHelper extends FormHelper
{
    public function tinymce(string $fieldName, array $options = []): string
    {
        $options += [
            'class' => 'tinymce-editor',
            'data-tinymce' => json_encode([
                'plugins' => 'advlist autolink lists link image charmap print preview anchor',
                'toolbar' => 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                'menubar' => true,
                'statusbar' => true,
                'promotion' => false,
            ]),
        ];

        return $this->textarea($fieldName, $options);
    }
}
