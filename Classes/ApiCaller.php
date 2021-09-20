<?php


class ApiCaller
{
    public function getDataFromApi (string $category) : array
    {
        $categories = ['business', 'health', 'entertainment', 'general', 'science', 'technology', 'sports'];
        if (!in_array($category, $categories)) {
            throw new Exception('Oops ! La page demandée n\'existe pas !');
        }                                                                                                     //VOTRE CLE API ICI//
        $url = 'https://newsapi.org/v2/top-headlines?country=fr&category=' . $category . '&pageSize=20&language=fr&apiKey=';
        $ressource = fopen($url, 'r');

        if (!is_resource($ressource)){
            throw New Exception('Une erreur est survenue');
        }

        $ressourceJSON = fgets($ressource);
        fclose($ressource);
        $data = json_decode($ressourceJSON, true);
        return $this->checkDataFromApi($data);
    }

    private function checkDataFromApi (array $data) : array
    {
        $dataFiltered = [];
        for ($i = 0 ; $i < count($data['articles']); $i++){
            if(
                isset($data['articles'][$i]['urlToImage']) &&
                isset($data['articles'][$i]['title']) &&
                isset($data['articles'][$i]['url'])
            ){
                $dataFiltered[] = $data['articles'][$i];
            }
        }
        return $dataFiltered;
    }
}