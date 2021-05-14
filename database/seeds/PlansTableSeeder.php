<?php 
use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
		$path = base_path() . '/database/seeds/plans.sql';
		$sql = file_get_contents($path);
		DB::unprepared($sql);
    }
}
?>