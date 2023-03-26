<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Foundation\Application;

class Task extends Model
{
    protected $app;

    public function __construct(array $attributes = [], LaravelApplication $app = null)
    {
        parent::__construct($attributes);
        $this->app = $app ?: app();
    }

    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
    ];

    protected function getValidationRules()
    {
        $rules = [
            'title' => 'required|max:255',
            'status' => 'required',
        ];
    
        return $rules;
    }
    
    
    public function save(array $options = [])
    {
        $validator = Validator::make($this->attributes, $this->getValidationRules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return parent::save($options);
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, $this->getValidationRules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
