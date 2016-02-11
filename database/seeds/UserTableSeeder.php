<?php    
    
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
   
class UserTableSeeder extends Seeder {
   
  public function run()
  {
    User::create([
      'name' => 'Todd McDew',
      'email' => 'todd@example.com',
      'password' => bcrypt('password'),
      'address' => '1234 Greenville Drive',
      'city' => 'Green Valley',
      'state' => 'South Carolina',
      'zip' => '29925',
      'is_admin' => true
    ]);
  }
}
