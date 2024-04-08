<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O :attribute campo deve ser aceito.',
    'accepted_if' => 'O :attribute campo deve ser aceito quando :other é :value.',
    'active_url' => 'O :attribute campo deve ser um URL válido.',
    'after' => 'O :attribute campo deve ser uma data após :date.',
    'after_or_equal' => 'O :attribute campo deve ser uma data posterior ou igual a :date.',
    'alpha' => 'O :attribute campo deve conter apenas letras.',
    'alpha_dash' => 'O :attribute campo deve conter apenas letras, números, travessões e sublinhados.',
    'alpha_num' => 'O :attribute campo deve conter apenas letras e números.',
    'array' => 'O :attribute campo deve ser uma matriz.',
    'ascii' => 'O :attribute campo deve conter apenas caracteres alfanuméricos e símbolos de byte único.',
    'before' => 'O :attribute campo deve ser uma data anterior :date.',
    'before_or_equal' => 'O :attribute campo deve ser uma data anterior ou igual a :date.',
    'between' => [
        'array' => 'O :attribute campo deve ter entre :min e :max unid.',
        'file' => 'O :attribute campo deve estar entre :min e :max quilobytes.',
        'numeric' => 'O :attribute campo deve estar entre :min e :max.',
        'string' => 'O :attribute campo deve estar entre :min e :max personagens.',
    ],
    'boolean' => 'O :attribute campo deve ser verdadeiro ou falso.',
    'can' => 'O :attribute campo contém um valor não autorizado.',
    'confirmed' => 'O :attribute a confirmação do campo não corresponde.',
    'current_password' => 'O senha é incorreta.',
    'date' => 'O :attribute campo deve ser uma data válida.',
    'date_equals' => 'O :attribute campo deve ser uma data igual a :date.',
    'date_format' => 'O :attribute campo deve corresponder ao formato :format.',
    'decimal' => 'O :attribute campo deve ter :decimal casas decimais.',
    'declined' => 'O :attribute campo deve ser recusado.',
    'declined_if' => 'O :attribute campo deve ser recusado quando :other é :value.',
    'different' => 'O :attribute campo e :other deve ser diferente.',
    'digits' => 'O :attribute campo deve ser :digits dígitos.',
    'digits_between' => 'O :attribute campo deve estar entre :min e :max dígitos.',
    'dimensions' => 'O :attribute campo tem dimensões de imagem inválidas.',
    'distinct' => 'O :attribute campo tem um valor duplicado.',
    'doesnt_end_with' => 'O :attribute campo não deve terminar com um dos seguintes: :values.',
    'doesnt_start_with' => 'O :attribute campo não deve começar com um dos seguintes: :values.',
    'email' => 'O :attribute campo deve ser um endereço de e-mail válido.',
    'ends_with' => 'O :attribute campo deve terminar com um dos seguintes: :values.',
    'enum' => 'O selected :attribute é inválido.',
    'exists' => 'O selected :attribute é inválido.',
    'extensions' => 'O :attribute campo deve ter uma das seguintes extensões: :values.',
    'file' => 'O :attribute campo deve ser um arquivo.',
    'filled' => 'O :attribute campo deve ter um valor.',
    'gt' => [
        'array' => 'O :attribute campo deve ter mais de :value unid.',
        'file' => 'O :attribute campo deve ser maior que :value quilobytes.',
        'numeric' => 'O :attribute campo deve ser maior que :value.',
        'string' => 'O :attribute campo deve ser maior que :value personagens.',
    ],
    'gte' => [
        'array' => 'O :attribute campo deve ter :value itens ou mais.',
        'file' => 'O :attribute campo deve ser maior ou igual a :value quilobytes.',
        'numeric' => 'O :attribute campo deve ser maior ou igual a :value.',
        'string' => 'O :attribute campo deve ser maior ou igual a :value personagens.',
    ],
    'hex_color' => 'O :attribute campo deve ter uma cor hexadecimal válida.',
    'image' => 'O :attribute campo deve ser uma imagem.',
    'in' => 'O selecionada :attribute é inválido.',
    'in_array' => 'O :attribute campo deve existir em :other.',
    'integer' => 'O :attribute campo deve ser um número inteiro.',
    'ip' => 'O :attribute campo deve ser um endereço IP válido.',
    'ipv4' => 'O :attribute campo deve ser um endereço IPv4 válido.',
    'ipv6' => 'O :attribute campo deve ser um endereço IPv6 válido.',
    'json' => 'O :attribute campo deve ser uma string JSON válida.',
    'lowercase' => 'O :attribute campo deve estar em letras minúsculas.',
    'lt' => [
        'array' => 'O :attribute campo deve ter menos que :value unid.',
        'file' => 'O :attribute campo deve ser menor que :value quilobytes.',
        'numeric' => 'O :attribute campo deve ser menor que :value.',
        'string' => 'O :attribute campo deve ser menor que :value personagens.',
    ],
    'lte' => [
        'array' => 'O :attribute campo não deve ter mais de :value unid.',
        'file' => 'O :attribute campo deve ser menor ou igual a :value quilobytes.',
        'numeric' => 'O :attribute campo deve ser menor ou igual a :value.',
        'string' => 'O :attribute campo deve ser menor ou igual a :value personagens.',
    ],
    'mac_address' => 'O :attribute campo deve ser um endereço MAC válido.',
    'max' => [
        'array' => 'O :attribute campo não deve ter mais de :max unid.',
        'file' => 'O :attribute campo não deve ser maior que :max quilobytes.',
        'numeric' => 'O :attribute campo não deve ser maior que :max.',
        'string' => 'O :attribute campo não deve ser maior que :max personagens.',
    ],
    'max_digits' => 'O :attribute campo não deve ter mais de :max dígitos.',
    'mimes' => 'O :attribute campo deve ser um arquivo do tipo: :values.',
    'mimetypes' => 'O :attribute campo deve ser um arquivo do tipo: :values.',
    'min' => [
        'array' => 'O :attribute campo deve ter pelo menos :min unid.',
        'file' => 'O :attribute campo deve ter pelo menos :min quilobytes.',
        'numeric' => 'O :attribute campo deve ter pelo menos :min.',
        'string' => 'O :attribute campo deve ter pelo menos :min personagens.',
    ],
    'min_digits' => 'O :attribute campo deve ter pelo menos :min dígitos.',
    'missing' => 'O :attribute campo deve estar faltando.',
    'missing_if' => 'O :attribute campo deve estar faltando quando :other é :value.',
    'missing_unless' => 'O :attribute campo deve estar faltando, a menos que :other é :value.',
    'missing_with' => 'O :attribute campo deve estar faltando quando :values é presente.',
    'missing_with_all' => 'O :attribute campo deve estar faltando quando :values estão presentes.',
    'multiple_of' => 'O :attribute campo deve ser um múltiplo de :value.',
    'not_in' => 'O selected :attribute é inválido.',
    'not_regex' => 'O :attribute formato do campo é inválido.',
    'numeric' => 'O :attribute campo deve ser um número.',
    'password' => [
        'letters' => 'O :attribute campo deve conter pelo menos uma letra.',
        'mixed' => 'O :attribute campo deve conter pelo menos uma letra maiúscula e uma minúscula.',
        'numbers' => 'O :attribute campo deve conter pelo menos um número.',
        'symbols' => 'O :attribute campo deve conter pelo menos um símbolo.',
        'uncompromised' => 'O dado :attribute apareceu em um vazamento de dados. Por favor escolha um diferente :attribute.',
    ],
    'present' => 'O :attribute campo deve estar presente.',
    'present_if' => 'O :attribute campo deve estar presente quando :other é :value.',
    'present_unless' => 'O :attribute campo deve estar presente, a menos que :other é :value.',
    'present_with' => 'O :attribute campo deve estar presente quando :values é presente.',
    'present_with_all' => 'O :attribute campo deve estar presente quando :values estão presentes.',
    'prohibited' => 'O :attribute campo é proibido.',
    'prohibited_if' => 'O :attribute campo é proibido quando :other é :value.',
    'prohibited_unless' => 'O :attribute campo é proibido, a menos que :other é em :values.',
    'prohibits' => 'O :attribute campo proíbe :other de estar presente.',
    'regex' => 'O :attribute formato do campo é inválido.',
    'required' => 'O :attribute campo é obrigatório.',
    'required_array_keys' => 'O :attribute campo deve conter entradas for: :values.',
    'required_if' => 'O :attribute campo é obrigatório quando :other é :value.',
    'required_if_accepted' => 'O :attribute campo é obrigatório quando :other é aceito.',
    'required_unless' => 'O :attribute campo é obrigatório, a menos que :other é em :values.',
    'required_with' => 'O :attribute campo é obrigatório quando :values é presente.',
    'required_with_all' => 'O :attribute campo é obrigatório quando :values estão presentes.',
    'required_without' => 'O :attribute campo é obrigatório quando :values não está presente.',
    'required_without_all' => 'O :attribute campo é obrigatório quando nenhum :values estão presentes.',
    'same' => 'O :attribute campo deve corresponder :other.',
    'size' => [
        'array' => 'O :attribute campo deve conter :size unid.',
        'file' => 'O :attribute campo deve ser :size quilobytes.',
        'numeric' => 'O :attribute campo deve ser :size.',
        'string' => 'O :attribute campo deve ser :size personagens.',
    ],
    'starts_with' => 'O :attribute campo deve começar com um dos following: :values.',
    'string' => 'O :attribute campo deve ser uma string.',
    'timezone' => 'O :attribute campo deve ser um fuso horário válido.',
    'unique' => 'O :attribute já foi tomada.',
    'uploaded' => 'O :attribute não foi possível fazer o upload.',
    'uppercase' => 'O :attribute campo deve ser maiúsculo.',
    'url' => 'O :attribute campo deve ser um URL válido.',
    'ulid' => 'O :attribute campo deve ser um ULID válido.',
    'uuid' => 'O :attribute campo deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
