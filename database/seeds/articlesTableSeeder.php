<?php

use Illuminate\Database\Seeder;

class articlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $articles = [
        [   "La Bóveda del fin del mundo cumple 10 años", 
            "Un mega proyecto que pretende salvaguardar la mayor cantidad de especies vegetales de la tierra, anticipandose a un armagedon o una catástrofe global, cumple una década.  Cada día son preservada mas de 1000 nuevas especies vegetales,las cuales se almacenan a bajas temperaturas.",
            "https://www.youtube.com/watch?v=m76gOnBj31Y&feature=youtu.be"
        ],
        [
            "Educación Tecnológica (digital) del futuro: Un día hecho de vidrio",
            "Los avances de la ciencia nos brindan un mundo fascinante, tecnologías maravillosas que conectan experiencias uniendo continentes de forma virtual y permitiendo a los ciudadanos del mundo vivir inmersos en una sociedad del conocimiento.",
            "https://www.youtube.com/watch?v=Usj5MBGkhKY&feature=youtu.be"
        ],
        [
            "Tres competencias básicas para el futuro | Pablo Heinig",
            "Pablo es ingeniero mecánico electricista y doctorando en Ocio y Desarrollo de Potencial Humano. Hoy fusiona mundos y se nutre de la filosofía, la psicología, el teatro y las artes marciales para desarrollar herramientas que promuevan el potencial humano. Es profesor de ESADE Business School Barcelona y dirige su propia consultora. ",
            "https://www.youtube.com/watch?v=cQVg1LfmGhE"
        ]

    ];

    public function run()
    {
        foreach($this->articles as $article) {
            DB::table("articles")->insert([
                'title' => $article[0],
                'content' => $article[1],
                'video' => $article[2]
            ]);
        }
    }
}
