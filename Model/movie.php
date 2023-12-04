<?php
class Movie
{
    private int $id;
    private string $title;
    private string $original_title;
    private string $overview;
    private float $vote_average;
    private string $poster_path;
    private string $original_language;

    public function __construct($id, $title, $subtitle, $overview, $vote, $image, $language)
    {
        $this->id = $id;
        $this->title = $title;
        $this->original_title = $subtitle;
        $this->overview = $overview;
        $this->vote_average = $vote;
        $this->poster_path = $image;
        $this->original_language = $language;
    }

    public function getVote()
    {
        $vote = ceil($this->vote_average / 2);
        $template = "<p>";
        for ($n = 1; $n <= 5; $n++) {
            $template .= $n <= $vote ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
        }
        $template .= "</p>";
        return $template;
    }

    public function printCard()
    {
        $image = $this->poster_path;
        $title = $this->title;
        $subtitle = $this->original_title;
        $content = substr($this->overview, 0, 100) . '...';
        $custom = $this->getVote();
        $language = $this->original_language;
        include __DIR__ . '/../Views/card.php';
    }
}

$movieString = file_get_contents(__DIR__ . '/movie_db.json');
$movieList = json_decode($movieString, true);

$movies = [];
foreach ($movieList as $item) {
    $movies[] = new Movie($item['id'], $item['title'], $item['original_title'], $item['overview'], $item['vote_average'], $item['poster_path'], $item['original_language']);
}
?>