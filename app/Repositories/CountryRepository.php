<?php
/**
 * Created by PhpStorm.
 * Country: andre
 * Date: 2018-09-12
 * Time: 8:56 PM
 */

namespace Ddondola\Repositories;


use Ddondola\Country;

class CountryRepository
{
    /**
     * Get default country
     *
     * @return Country
     */
    public function default()
    {
        return $this->code(config('app.countries.default'));
    }

    /**
     * Get Country by id
     *
     * @param $id
     * @return Country
     */
    public function id($id) {
        return Country::find($id);
    }

    /**
     * Get Country from code
     *
     * @param $code
     * @return Country
     */
    public function code($code) {
        return Country::where('code', $code)->first();
    }

    /**
     * All supported countries
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all() {
        return Country::all();
    }

    /**
     * All active countries
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function active() {
        return Country::where('active', 1)->get();
    }

    /**
     * Create new Country
     *
     * @param $data
     * @return Country
     */
    public function create($data) {
        return Country::create($data);
    }

    /**
     * add new countries
     */
    public function addCountries() {
        collect(countries())->only(config('app.countries.supported'))->each(function ($value, $key){
            if(!$this->code($key)) {
                $this->create(["code" => $key, "name" => $value["name"]]);
            }
        });
    }
}