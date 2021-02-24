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

  'accepted' => 'O campo :attribute tem que ser aceito.',
  'active_url' => 'O campo :attribute não é uma url válida.',
  'after' => 'O campo :attribute must be a date after :date.',
  'after_or_equal' => 'O campo :attribute must be a date after or equal to :date.',
  'alpha' => 'O campo :attribute deve conter apenas letras.',
  'alpha_dash' => 'O campo :attribute deve conter apenas letras, números, traços e sublinhados.',
  'alpha_num' => 'O campo :attribute deve conter apenas letras e números.',
  'array' => 'O campo :attribute tem que ser uma lista.',
  'before' => 'O campo :attribute deve ser uma data antes de :date.',
  'before_or_equal' => 'O campo :attribute deve ser uma data antes ou igual a :date.',
  'between' => [
    'numeric' => 'O campo :attribute deve estar entre :min e :max.',
    'file' => 'O campo :attribute deve estar entre :min e :max kb.',
    'string' => 'O campo :attribute deve ter entre :min e :max carácteres.',
    'array' => 'O campo :attribute deve ter entre :min e :max itens.',
  ],
  'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
  'confirmed' => 'O campo :attribute não bate com a confirmação.',
  'date' => 'O campo :attribute não é uma data válida.',
  'date_equals' => 'O campo :attribute deve ser uma data igual a :date.',
  'date_format' => 'O campo :attribute não se encaixa no fromaato :format.',
  'different' => 'O campo :attribute e :other devem ser diferentes.',
  'digits' => 'O campo :attribute devem ter :digits digitos.',
  'digits_between' => 'O campo :attribute devem ter :min e :max digitos.',
  'dimensions' => 'O campo :attribute tem dimensões inválidas.',
  'distinct' => 'O campo :attribute tem um valor duplicado.',
  'email' => 'O campo :attribute tem que ser um endereço de email válido.',
  'ends_with' => 'O campo :attribute tem que terminar com um dos valores: :values',
  'exists' => 'O campo selecionado :attribute é inválido.',
  'file' => 'O campo :attribute tem que ser um arquivo.',
  'filled' => 'O campo :attribute tem que ter um valor.',
  'gt' => [
    'numeric' => 'O campo :attribute tem que ser maior do que :value.',
    'file' => 'O campo :attribute tem que ser maior do que :value kb.',
    'string' => 'O campo :attribute tem que ter mais que :value carácteres.',
    'array' => 'O campo :attribute tem que ter mais que :value itens.',
  ],
  'gte' => [
    'numeric' => 'O campo :attribute tem que ser maior ou igual do que :value.',
    'file' => 'O campo :attribute tem que ser maior ou igual do que :value kb.',
    'string' => 'O campo :attribute tem que ter mais ou a mesma quantidade de carácteres que :value carácteres.',
    'array' => 'O campo :attribute tem que ter mais ou a mesma que :value itens.',
  ],
  'image' => 'O campo :attribute tem que ser uma imagem.',
  'in' => 'O campo selected :attribute é inválido.',
  'in_array' => 'O campo :attribute field não existe em :other.',
  'integer' => 'O campo :attribute tem que ser um inteiro.',
  'ip' => 'O campo :attribute tem que ser um endereço de ip válido.',
  'ipv4' => 'O campo :attribute tem que ser um endereço de ipv4 válido.',
  'ipv6' => 'O campo :attribute tem que ser um endereço de ipv6 válido.',
  'json' => 'O campo :attribute tem que ser um json válido.',
  'lt' => [
    'numeric' => 'O campo :attribute tem que ser menor do que :value.',
    'file' => 'O campo :attribute tem que ser menor do que :value kb.',
    'string' => 'O campo :attribute tem que ter menos que :value carácteres.',
    'array' => 'O campo :attribute tem que ter menos que :value itens.',
  ],
  'lte' => [
    'numeric' => 'O campo :attribute tem que ser menor ou igual do que :value.',
    'file' => 'O campo :attribute tem que ser menor ou igual do que :value kb.',
    'string' => 'O campo :attribute tem que ter menos ou a mesma quantidade de carácteres que :value carácteres.',
    'array' => 'O campo :attribute tem que ter menos ou a mesma que :value itens.',
  ],
  'max' => [
    'numeric' => 'O campo :attribute não pode ser maior que :max.',
    'file' => 'O campo :attribute não pode ser maior que :max kb.',
    'string' => 'O campo :attribute não pode ter mais que :max carácteres.',
    'array' => 'O campo :attribute não pode ter mais que :max itens.',
  ],
  'mimes' => 'O campo :attribute tem que ser do tipo de arquivo: :values.',
  'mimetypes' => 'O campo :attribute tem que ser do mimetype: :values.',
  'min' => [
    'numeric' => 'O campo :attribute tem que ter no mínimo :min.',
    'file' => 'O campo :attribute tem que ter no mínimo :min kb.',
    'string' => 'O campo :attribute tem que ter no mínimo :min carácteres.',
    'array' => 'O campo :attribute tem que ter no mínimo :min itens.',
  ],
  'not_in' => 'O campo selecionado :attribute é inválido.',
  'not_regex' => 'O campo :attribute não possui um formato válido.',
  'numeric' => 'O campo :attribute tem que ser um número.',
  'present' => 'O campo :attribute tem que existir.',
  'regex' => 'O campo :attribute tem um formato inválido.',
  'required' => 'O campo :attribute é requerido.',
  'required_if' => 'O campo :attribute é requerido quando :other é :value.',
  'required_unless' => 'O campo :attribute é requerido a não ser que :other sejam :values.',
  'required_with' => 'O campo :attribute é requerido quando algum dos :values existem.',
  'required_with_all' => 'O campo :attribute é requerido quando :values existem.',
  'required_without' => 'O campo :attribute é requerido quando :values não existem.',
  'required_without_all' => 'O campo :attribute é requerido quando nenhum dos valores :values existem.',
  'same' => 'Os campos :attribute e :other tem que ser o mesmo.',
  'size' => [
    'numeric' => 'O campo :attribute tem que ser :size.',
    'file' => 'O campo :attribute tem que possuir :size kb.',
    'string' => 'O campo :attribute tem que conter :size caracteres.',
    'array' => 'O campo :attribute tem que conter :size itens.',
  ],
  'starts_with' => 'O campo :attribute tem que iniciar com um dos valores: :values',
  'string' => 'O campo :attribute tem que ser um text.',
  'timezone' => 'O campo :attribute tem que ser uma timezone válida.',
  'unique' => 'O campo :attribute já está sendo utilizado.',
  'uploaded' => 'O campo :attribute falhou para fazer upload.',
  'url' => 'O formato do campo :attribute é inválido.',
  'uuid' => 'O campo :attribute tem que ser um UUID.',

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
