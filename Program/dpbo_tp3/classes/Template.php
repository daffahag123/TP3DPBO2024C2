<?php

class Template
{
    var $filename = ''; // Nama file template
    var $content = '';  // Isi konten dari template

    function __construct($filename = '')
    {
        $this->filename = $filename;

        // Mengambil konten dari file template
        $this->content = implode('', @file($filename));
    }

    function clear()
    {
        // Membersihkan konten template dari placeholder DATA_*
        $this->content = preg_replace("/DATA_[A-Z|_|0-9]+/", "", $this->content);
    }

    function write()
    {
        // Menampilkan konten template setelah membersihkan placeholder
        $this->clear();
        print $this->content;
    }

    function getContent()
    {
        // Mengembalikan konten template setelah membersihkan placeholder
        $this->clear();
        return $this->content;
    }

    function replace($old = '', $new = '')
    {
        // Mengganti placeholder $old dengan nilai $new dalam konten template
        if (is_int($new)) {
            $value = sprintf("%d", $new);
        } elseif (is_float($new)) {
            $value = sprintf("%f", $new);
        } elseif (is_array($new)) {
            $value = '';

            foreach ($new as $item) {
                $value .= $item . ' ';
            }
        } else {
            $value = $new;
        }
        $this->content = preg_replace("/$old/", $value, $this->content);
    }
}
