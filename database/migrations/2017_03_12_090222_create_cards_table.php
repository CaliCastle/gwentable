<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 卡牌 表
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // 名称 (比如ciri, i18n用法为en.cards.{ciri})
            $table->string('property'); // 属性
            $table->unsignedSmallInteger('strength'); // 力量
            $table->tinyInteger('type'); // 类型, 0:铜, 1:银, 2:金
            $table->tinyInteger('faction'); // 阵营
            $table->tinyInteger('rarity'); // 稀有度 (Common, rare, epic, legendary)
            $table->boolean('premium'); // 是否动画
            $table->tinyInteger('loyal'); // 忠诚度, 间谍/忠诚/墙头草
            $table->unsignedInteger('art_id'); // 封面图
            $table->timestamps();

            // 额外属性
            $table->text('extra');

            // 外键约束
            $table->foreign('art_id')->reference('id')->on('files');
        });

        // 卡牌属性 表
        Schema::create('card_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique(); // 属性名, 如『巫师』/『女巫』/『狂烈』/『特效』
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_properties');
        Schema::dropIfExists('cards');
    }
}
