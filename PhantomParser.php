<?php

use JonnyW\PhantomJs\Client;

class PhantomParser {

    private $id;

    private $keyword;

    private $page = 1;

    private $pageLimit;

    private $client;

    function __construct(int $id, string $keyword, int $seconds = 0, int $numberOfPages = 10)
    {
            $this->id = $id;
            $this->keyword = $keyword;
            $this->setTimeLimit($seconds);
            $this->setPageLimit($numberOfPages);
            $this->client = $this->setupClient();
    }

    public function run()
    {
        $response = $this->makeRequest();

        if ($response === null) {
            $result['limitMessage'] = "В рамках установленного лимита просматриваемых страниц ({$this->pageLimit} страниц) результат не был найден.";
            return $result;
        }

        if ($response->getStatus() === 200) {
            $output = $response->getContent();
            preg_match('/data-track-value="{&quot;seq&quot;:&quot;(\d+)&quot;,&quot;id&quot;:&quot;' . $this->id . '&quot;}"/', $output, $matches);
            if (!empty($matches)) {
                $result['position'] = $matches[1];
                $result['page'] = $this->page;
                return $result;
            } else {
                // если нет совпадения - посылаем запрос с get параметром следующей страницы
                $this->page++;
                return $this->run();
            }
        }
    }

    private function makeRequest()
    {
        if ($this->page > $this->pageLimit) {
            return null;
        } else if ($this->page != 1) {
            $url = 'https://www.shutterstock.com/ru/search/' . $this->keyword . '?page=' . $this->page;
        } else {
            $url = 'https://www.shutterstock.com/ru/search/' . $this->keyword;
        }

        $request = $this->client->getMessageFactory()->createRequest($url, 'GET');
        $request->addHeader("User-Agent", "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36");

        $response = $this->client->getMessageFactory()->createResponse();
        $request->setTimeout(20000); // 20 seconds

        // Send the request
        return $this->client->send($request, $response);
    }

    private function setupClient()
    {
        $client = Client::getInstance();
        $client->getEngine()->setPath(dirname(__FILE__) . '\vendor\bin\\phantomjs.exe');
        $client->isLazy();
        return $client;
    }

    public function setTimeLimit(int $seconds)
    {
        set_time_limit($seconds);
    }

    public function setPageLimit(int $number)
    {
        $this->pageLimit = $number;
    }
}
