<?php

return [
    'operator' => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'options' => [
                'equal_to'                 => 'anomaly.extension.subtotal_discount_condition::configuration.operator.options.equal_to',
                'not_equal_to'             => 'anomaly.extension.subtotal_discount_condition::configuration.operator.options.not_equal_to',
                'equal_to_or_greater_than' => 'anomaly.extension.subtotal_discount_condition::configuration.operator.options.equal_to_or_greater_than',
                'equal_to_or_less_than'    => 'anomaly.extension.subtotal_discount_condition::configuration.operator.options.equal_to_or_less_than',
                'greater_than'             => 'anomaly.extension.subtotal_discount_condition::configuration.operator.options.greater_than',
                'less_than'                => 'anomaly.extension.subtotal_discount_condition::configuration.operator.options.less_than',
            ],
        ],
    ],
    'value'    => [
        'required' => true,
        'type'     => 'anomaly.field_type.decimal',
    ],
];
