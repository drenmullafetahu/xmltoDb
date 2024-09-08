<?php

use PHPUnit\Framework\TestCase;
use App\XmlProc;
use App\MysqlDatabase;
use App\Logger;

class XMLProcessorTest extends TestCase
{
    public function testProcess()
    {
        $logger = $this->createMock(Logger::class);
        $db = $this->createMock(MysqlDatabase::class);

        $db->expects($this->exactly(3449))->method('insert');
        $processor = new XmlProc($db, $logger);
        $processor->process('_DIR_' . '/../feed.xml');
    }
}