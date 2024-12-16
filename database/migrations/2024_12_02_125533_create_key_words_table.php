<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_words', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->timestamps();
        });
        $keywords = [
            'Hiệp khách',
            'Hiệp khách giang hồ',
            'Hiệp khách VTC',
            'Hiệp khách giang hồ VTC',
            'hkgh',
            'hkgh vtc',
            'tải game hkgh',
            'tải game hiệp khách giang hồ',
            'nhiệm vụ hiệp khách giang hồ',
            'hướng dẫn hiệp khách giang hồ',
            'cẩm nang hiệp khách giang hồ',
            'auto hiệp khách giang hồ',
            'Giftcode Hiệp Khách Giang Hồ',
            'Sự kiện Hiệp Khách Giang Hồ',
            'Giải đấu Hiệp Khách Giang Hồ',
            'Hướng dẫn nâng cấp trang bị Hiệp Khách Giang Hồ',
            'Cách chơi Hiệp Khách Giang Hồ cho người mới',
            'Cách chọn hệ phái phù hợp trong Hiệp Khách Giang Hồ cho người mới'
        ];
        foreach ($keywords as $keyword) {
            \App\Models\KeyWord::create([
                'keyword' => $keyword
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('key_words');
    }
}
