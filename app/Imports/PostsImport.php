<?php

namespace App\Imports;

use App\Post;
use Carbon\Carbon;
use App\Rules\Phone;
use App\Rules\UnlimitedLifetime;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

//class PostsImport implements ToModel, WithStartRow, WithValidation
class PostsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*
    public function model(array $row)
    {
        if (!$row[1]) {
            return null;
        }
        $post['user_id'] = auth()->user()->id;
        $post['title'] = $row[1];
        $post['description'] = $row[2];
        $post['thread'] = $row[3];
        $post['company'] = $row[4];
        $post['type'] = $row[5];
        $post['role'] = $row[6];
        $post['condition'] = $row[7];
        $post['tag_encoded'] = $row[8];
        $post['manufacturer'] = $row[9];
        $post['manufactured_date'] = $row[10];
        $post['part_number'] = $row[11];
        $post['cost'] = $row[12];
        $post['currency'] = $row[13];
        $post['region_encoded'] = $row[14];
        $post['town'] = $row[15];
        $post['user_email'] = $row[16];
        $post['user_phone_raw'] = $row[17];
        $post['viber'] = $row[18] ? 1 : 0;
        $post['telegram'] = $row[19] ? 1 : 0;
        $post['whatsapp'] = $row[20] ? 1 : 0;
        $post['lifetime'] = $row[21];
        switch ($post['lifetime']) {
            case '1':
                $post['active_to'] = Carbon::now()->addMonth()->toDateString();
            break;
            case '2':
                $post['active_to'] = Carbon::now()->addMonths(2)->toDateString();
            break;
            case '3':
                $post['active_to'] = null;
                break;
            default:
                break;
        }
        $this->translate($post);
        //dd($post);
        return new Post([
            'user_id' => $post['user_id'],
            'title' => $row[1],
            'description' => $post['description'],
            'thread' => $post['thread'],
            'company' => $post['company'],
            'type' => $post['type'],
            'role' => $post['role'],
            'condition' => $post['condition'],
            'tag_encoded' => $post['tag_encoded'],
            'manufacturer' => $post['manufacturer'],
            'manufactured_date' => $post['manufactured_date'],
            'part_number' => $post['part_number'],
            'cost' => $post['cost'],
            'currency' => $post['currency'],
            'region_encoded' => $post['region_encoded'],
            'town' => $post['town'],
            'user_email' => $post['user_email'],
            'user_phone_raw' => $post['user_phone_raw'],
            'viber' => $post['viber'],
            'telegram' => $post['telegram'],
            'whatsapp' => $post['whatsapp'],
            'lifetime' => $post['lifetime'],
            'origin_lang' => $post['origin_lang'],
        ]);
    }

    public function rules(): array {
        return [
            '1' => 'string|min:10|max:70',
            '2' => 'string|min:10|max:9000',
            '3' => function($attribute, $value, $onFailure) {
                if ($value!=1 && $value!=2) {
                    $onFailure('incorrect thread');
                }
            },
            '4' => 'nullable|string|min:5|max:200',
            '5' => function($attribute, $value, $onFailure) {
                if ($value!=1 && $value!=2 && $value!=3 && $value!=4 && $value!=5 && $value!=6) {
                    $onFailure('incorrect type');
                }
            },
            '6' => function($attribute, $value, $onFailure) {
                if ($value!=1 && $value!=2) {
                    $onFailure('incorrect role');
                }
            },
            '7' => function($attribute, $value, $onFailure) {
                if ($value!=1 && $value!=2 && $value!=3 && $value!=4) {
                    $onFailure('incorrect condition');
                }
            },
            '9' => 'nullable|string|min:5|max:70',
            '10' => 'nullable|string|min:5|max:70',
            '11' => 'nullable|string|min:3|max:70',
            '12' => 'nullable|string|max:50',
            '13' => function($attribute, $value, $onFailure) {
                if ($value!='UAH' && $value!='USD') {
                    $onFailure('incorrect currency');
                }
            },
            '15' => 'nullable|string|max:100',
            '16' => 'nullable|email|max:255',
            '17' => ['nullable', 'string', 'size:16', new Phone],
            '21' => function($attribute, $value, $onFailure) {
                if ($value!=1 && $value!=2 && $value!=3) {
                    $onFailure('incorrect lifetime');
                }
            },

            // Above is alias for as it always validates in batches
            //'*.1' => Rule::in(['patrick@maatwebsite.nl']),
             
            // Can also use callback validation rules
            /*
            '0' => function($attribute, $value, $onFailure) {
                if ($value == 0) {
                    $onFailure('First elemt ignored');
                }
            }
            */
            /*
        ];
    }

    public function customValidationMessages()
    {
        return [
            '1.in' => 'Custom message for :attribute.',
        ];
    }

    private function translate(&$post) {
        $post['origin_lang'] = 'en';
    }
    */

    public function startRow(): int
    {
        return 3;
    }

    public function limit(): int
    {
        return 1;
    }
}
