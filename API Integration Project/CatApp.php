<?php
/**
 * Cat app class, Controls the main logic of the app
 */
    class CatApp{
    private $api;
    public function __construct(CatApi $api){
        $this->api = $api;
    }
    /**
     * Displays 10 random cat pictures content using bootstrap for layout
     * no pagination, you can just refresh the page when you want another 10 random cat pics
     */
    public function showRandomCats(){
        $cats = $this->api->getRandomCats();
        if(empty($cats)){
            echo "<p>No Cats Found</p>";
            return;
        }
        ?>
    <section class="container-fluid px-4">
    <h2 class="text-center page-title p-3">10 Random Cat Pics</h2>
    <div class="row row-cols-2 row-cols-md-5 g-4">
        <?php
        foreach ($cats as $cat) {
            $breedName = htmlspecialchars($cat['breeds'][0]['name'] ?? "Unknown breed"); // set with the same names that match Cat API docs
            $imageURL  = htmlspecialchars($cat['url'] ?? 'https://via.placeholder.com/100x150.png?text=No+Image');
            echo "<div class='col'>";
            echo "  <div class='card h-100 text-center'>";
            echo "    <img src='{$imageURL}' class='cat-img card-img-top img-fluid' alt='{$breedName}'>";
            echo "    <div class='card-body d-flex align-items-end justify-content-center'>";
            echo "      <h5 class='card-title mb-0'>{$breedName}</h5>";
            echo "    </div>";
            echo "  </div>";
            echo "</div>";
        }
        ?>
    </div>
    </section>
<?php
    }
    }