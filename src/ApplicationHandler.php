<?php

namespace App;

class ApplicationHandler
{
    private string $file;

    public function __construct(int $argc, array $argv)
    {
        $this->file = $argv[1];
    }

    public function run()
    {
        $handler = new FileBuilder;
        $handler->load($this->file)
            ->process()
            ->out();
    }
}