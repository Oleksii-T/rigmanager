<?php

namespace App\Imports;

use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PostsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Post([
            'title'         => $row[1], 
            'description'   => $row[2],
            'is_banned'   => 0,
            'is_active'   => 0,
            'thread'   => 1,
            'origin_lang'   => 'en',
            'user_id'       => '1',
            /*
            $table->id();
            $table->foreignId('user_id');
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('thread');
            $table->string('origin_lang', 5);
            $table->json('user_translations')->nullable();
            $table->string('title', 100);
            $table->string('title_uk', 100)->nullable();
            $table->string('title_ru', 100)->nullable();
            $table->string('title_en', 100)->nullable();
            $table->string('company', 255)->nullable(); //company name
            $table->string('type', 2); // sell/buy/loan
            $table->string('role', 2); // private/bussiness
            $table->integer('condition')->nullable();
            $table->string('tag_encoded', 255);
            $table->string('manufacturer', 80)->nullable();
            $table->string('manufactured_date', 80)->nullable();
            $table->string('part_number', 80)->nullable();
            $table->text('description', 9000);
            $table->text('description_uk', 9000)->nullable();
            $table->text('description_ru', 9000)->nullable();
            $table->text('description_en', 9000)->nullable();
            $table->double('cost', 50, 2)->nullable();
            $table->string('currency', 4)->nullable();
            $table->string('region_encoded', 10)->nullable();
            $table->string('town', 255)->nullable();
            $table->string('user_email', 255)->nullable();
            $table->string('user_phone_raw', 11)->nullable();
            $table->boolean('viber')->default(false);
            $table->boolean('telegram')->default(false);
            $table->boolean('whatsapp')->default(false);
            $table->string('lifetime')->default(1);
            $table->date('active_to')->default(Carbon::now()->addMonth())->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0); // Adds a nullable deleted_at TIMESTAMP equivalent column for soft deletes with precision (total digits).
            */
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
