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

    'accepted' => ':attribute harus disetujui.',
    'active_url' => ':attribute bukanlah url yang valid.',
    'after' => ':attribute harus tanggal setelah :date.',
    'after_or_equal' => ':attribute tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, nomor, tanda hubung dan garis bawah.',
    'alpha_num' => ':attribute hanya boleh berisi huruf dan nomor.',
    'array' => ':attribute hanya boleh berupa array.',
    'before' => ':attribute harus tangal setelah :date.',
    'before_or_equal' => ':attribute harus tangal setelah atau sama dengan :date.',
    'between' => [
        'numeric' => ':attribute harus antara :min dan :max.',
        'file' => ':attribute harus antara :min dan :max kilobytes.',
        'string' => ':attribute harus antara :min dan :max karakter.',
        'array' => ':attribute harus ada di antara :min dan :max item.',
    ],
    'boolean' => ':attribute field harus berupa true atau false.',
    'confirmed' => ':attribute konfirmasi tidak sama.',
    'date' => ':attribute bukan tanggal yang valid.',
    'date_equals' => ':attribute harus tanggal yang sama dengan :date.',
    'date_format' => ':attribute tidak sesuai dengan format :format.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus :digits digit.',
    'digits_between' => ':attribute harus diantara :min dan :max digit.',
    'dimensions' => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => ':attribute field memiliki nilai duplikat.',
    'email' => ':attribute Harus alamat e-mail yang valid.',
    'ends_with' => ':attribute harus diakhiri dengan salah satu dari berikut ini: :values.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'file' => ':attribute harus berupa file.',
    'filled' => ':attribute field harus memiliki nilai',
    'gt' => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file' => ':attribute harus lebih besar dari :value kilobytes.',
        'string' => ':attribute harus lebih besar dari :value karakter.',
        'array' => ':attribute harus memiliki lebih dari :value items.',
    ],
    'gte' => [
        'numeric' => ':attribute harus lebih besar dari atau sama dengan :value.',
        'file' => ':attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string' => ':attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array' => ':attribute harus memiliki :value item atau lebih.',
    ],
    'image' => ':attribute harus sebuah gambar.',
    'in' => ':attribute yang dipilih tidak valid.',
    'in_array' => ':attribute field  tidak ada di :other.',
    'integer' => ':attribute harus bernilai integer(bilangan bulat).',
    'ip' => ':attribute harus sebuah alamat IP yang valid.',
    'ipv4' => ':attribute harus sebuah alamat IPv4 yang valid.',
    'ipv6' => ':attribute harus sebuah alamat IPv6 yang valid.',
    'json' => ':attribute harus sebuah JSON yang valid.',
    'lt' => [
        'numeric' => ':attribute harus kurang dari :value.',
        'file' => ':attribute harus kurang dari :value kilobytes.',
        'string' => ':attribute harus kurang dari :value karakter.',
        'array' => ':attribute harus memiliki kurang dari :value items.',
    ],
    'lte' => [
        'numeric' => ':attribute harus kurang dari atau sama dengan :value.',
        'file' => ':attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => ':attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => ':attribute tidak boleh lebih dari :value item.',
    ],
    'max' => [
        'numeric' => ':attribute tiak lebih besar dari :max.',
        'file' => ':attribute tiak lebih besar dari :max kilobytes.',
        'string' => ':attribute tiak lebih besar dari :max karakter.',
        'array' => ':attribute tidak boleh memiliki lebih dari :max item.',
    ],
    'mimes' => ':attribute harus berupa file dengan tipe: :values.',
    'mimetypes' => ':attribute harus berupa file dengan tipe: :values.',
    'min' => [
        'numeric' => ':attribute setidaknya harus :min.',
        'file' => ':attribute setidaknya harus :min kilobytes.',
        'string' => ':attribute setidaknya harus :min karakter.',
        'array' => ':attribute setidaknya harus memiliki :min item.',
    ],
    'not_in' => ':attribute yang dipilih tidak valid.',
    'not_regex' => ':attribute format tidak valid.',
    'numeric' => ':attributeharus berupa nomor.',
    'password' => 'Password yang anda masukan salah.',
    'present' => ':attribute field harus hadir.',
    'regex' => ':attributememiliki format yang salah.',
    'required' => ':attribute field tidak boleh kosong.',
    'required_if' => ':attribute field tidak boleh kosong ketika :other adalah :value.',
    'required_unless' => ':attribute field tidak boleh kosong kecuali :other ada didalam nilai :values.',
    'required_with' => ':attribute field tidak boleh kosong ketika ada :values.',
    'required_with_all' => ':attribute field  tidak boleh kosong ketika ada :values secara keseluruhan.',
    'required_without' => ':attribute field  tidak boleh kosong ketika :values tidak ada.',
    'required_without_all' => ':attribute field  tidak boleh kosong ketika tidak ada :values secara keseluruhan.',
    'same' => ':attribute dan :other harus sama.',
    'size' => [
        'numeric' => ':attribute harus :size.',
        'file' => ':attribute harus :size kilobytes.',
        'string' => ':attribute harus :size karakter.',
        'array' => ':attribute harus terdapat :size item.',
    ],
    'starts_with' => ':attribute harus dimulai dengan salah satu dari berikut ini: :values.',
    'string' => ':attribute harus berupa string().',
    'timezone' => ':attribute harus berupa zona yang valid.',
    'unique' => ':attribute sudah pernah dipakai.',
    'uploaded' => ':attribute gagal di upload.',
    'url' => ':attribute memiliki format yang salah.',
    'uuid' => ':attribute harus sebuah UUID yang valid.',

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
