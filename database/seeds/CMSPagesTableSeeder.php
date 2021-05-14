<?php 
use App\Models\CmsPage;
use Illuminate\Database\Seeder;

class CMSPagesTableSeeder extends Seeder
{
    public function run()
    {
		$path = base_path() . '/database/seeds/cms.sql';
		$sql = file_get_contents($path);
		DB::unprepared($sql);
    }
}
?>