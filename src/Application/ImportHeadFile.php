<?php

namespace App\Application;

class ImportHeadFile {

    public function __construct(private readonly string $url){}
    private array $css = [];
    private array $js = [];

    public function getCss($filesName = []): string
    {
        $head = '';
        if ($filesName && count($filesName) > 0) {
            foreach ($filesName as $file) {
                $this->css[] = "<link rel='stylesheet' href='$this->url/public/css/$file'>";
            }
        }

        foreach ($this->css as $file) {
            $head .= $file;
        }

        return $head;
    }

    public function getJs($filesName = []): string
    {
        $head = '';
        if ($filesName && count($filesName) > 0) {
            foreach ($filesName as $file) {
                $this->js[] = "<script src='$this->url/public/javascript/$file'></script>";
            }
        }

        foreach ($this->js as $file) {
            $head .= $file;
        }

        return $head;
    }
}
