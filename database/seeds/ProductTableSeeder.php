    <?php    
      
    use Illuminate\Database\Seeder;
    use Illuminate\Database\Eloquent\Model;
    use App\Product;
     
    class ProductTableSeeder extends Seeder {
     
      public function run()
      {
        Product::create([
          'name'        => 'WDL Garden Spade',
          'description' => 'Manufactured from robust plastic and sporting a yellow handle, this spade is a required tool in any garden.',
          'sku'         => 'garden_spade',
          'price'       => 14.99
        ]);
        
        Product::create([
          'name'        => 'WDL Sand Scoop',
          'description' => 'Backyard sand sculptures will be built in no time with this wide mouth sand scoop.',
          'sku'         => 'sand_scoop',
          'price'       => 6.99
        ]);

        Product::create([
          'name'        => 'WDL Shovel Set',
          'description' => "Wow your neighbors with this stylish shovel set.",
          'sku'         => 'shovel_set',
          'price'       => 19.99
        ]);

        Product::create([
          'name'        => 'Earth Mover',
          'description' => "Transfer dirt by the handful using this people-powered earth mover.",
          'sku'         => 'earth_mover',
          'price'       => 39.99
        ]);

        Product::create([
          'name'            => "Todd McDew's Lawn Care Guide",
          'description'     => "Green your lawn fast with tips from expert Todd McDew.",
          'sku'             => 'lawn_care_guide',
          'price'           => 9.99,
          'is_downloadable' => true
        ]);

        $imageSeeds = base_path() . '/database/seeds/images/';
        $downloadSeeds = base_path() . '/database/seeds/downloads/';
        $downloads = storage_path() . '/downloads/';
        $catalog = base_path() . '/public/imgs/products/';

        if (!file_exists($catalog)) {
            mkdir($catalog, 0777, true);
        }

        // Seed the product images
        $files = scandir($imageSeeds);

        foreach ($files as $file) {
          if ($file != '.' && $file != '..') {
            copy($imageSeeds . $file, $catalog . $file);
          }
        }

        // Seed the downloads
        $files = scandir($downloadSeeds);

        foreach ($files as $file) {
          if ($file != '.' && $file != '..') {
            copy($downloadSeeds . $file, $downloads . $file);
          }
        }

      }
    }
