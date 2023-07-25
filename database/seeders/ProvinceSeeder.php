<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Province::query()->count()) return;

        $query = "INSERT INTO `provinces` VALUES (1,'آذربایجان شرقی',NULL,NULL,NULL,NULL,NULL,'inactive'),(2,'آذربایجان غربی',NULL,NULL,NULL,NULL,NULL,'inactive'),(3,'اردبیل',NULL,NULL,NULL,NULL,NULL,'inactive'),(4,'اصفهان',NULL,NULL,NULL,NULL,NULL,'active'),(5,'البرز',NULL,NULL,NULL,NULL,NULL,'inactive'),(6,'ایلام',NULL,NULL,NULL,NULL,NULL,'inactive'),(7,'بوشهر',NULL,NULL,NULL,NULL,NULL,'inactive'),(8,'تهران',NULL,NULL,NULL,NULL,NULL,'inactive'),(9,'چهارمحال وبختیاری',NULL,NULL,NULL,NULL,NULL,'inactive'),(10,'خراسان جنوبی',NULL,NULL,NULL,NULL,NULL,'inactive'),(11,'خراسان رضوی',NULL,NULL,NULL,NULL,NULL,'inactive'),(12,'خراسان شمالی',NULL,NULL,NULL,NULL,NULL,'inactive'),(13,'خوزستان',NULL,NULL,NULL,NULL,NULL,'inactive'),(14,'زنجان',NULL,NULL,NULL,NULL,NULL,'inactive'),(15,'سمنان',NULL,NULL,NULL,NULL,NULL,'inactive'),(16,'سیستان وبلوچستان',NULL,NULL,NULL,NULL,NULL,'inactive'),(17,'فارس',NULL,NULL,NULL,NULL,NULL,'inactive'),(18,'قزوین',NULL,NULL,NULL,NULL,NULL,'inactive'),(19,'قم',NULL,NULL,NULL,NULL,NULL,'inactive'),(20,'کردستان',NULL,NULL,NULL,NULL,NULL,'inactive'),(21,'کرمان',NULL,NULL,NULL,NULL,NULL,'inactive'),(22,'کرمانشاه',NULL,NULL,NULL,NULL,NULL,'inactive'),(23,'کهگیلویه وبویراحمد',NULL,NULL,NULL,NULL,NULL,'inactive'),(24,'گلستان',NULL,NULL,NULL,NULL,NULL,'inactive'),(25,'گیلان',NULL,NULL,NULL,NULL,NULL,'inactive'),(26,'لرستان',NULL,NULL,NULL,NULL,NULL,'inactive'),(27,'مازندران',NULL,NULL,NULL,NULL,NULL,'inactive'),(28,'مرکزی',NULL,NULL,NULL,NULL,NULL,'inactive'),(29,'هرمزگان',NULL,NULL,NULL,NULL,NULL,'inactive'),(30,'همدان',NULL,NULL,NULL,NULL,NULL,'inactive'),(31,'یزد',NULL,NULL,NULL,NULL,NULL,'inactive');";

        DB::statement($query);
    }
}
