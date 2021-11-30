<?php

namespace app\App\Controllers;

use app\App\Models\Hospital;
use Rakit\Validation\Validator;

class HospitalsController
{

    public function index()
    {

        $hospital = Hospital::query();

        if (input()->exists('orderByUserCount')) {
            $hospital->withCount('users')->orderBy('users_count', 'desc');
        }

        response()->json($hospital->get());
    }

    public function show($id)
    {
        $hospital = Hospital::where('id', '=', $id)->first();

        !is_null($hospital) ? response()->json($hospital) : response()->json([]);
    }

    public function store()
    {

        $data = input()->all([
            'name',
            'address',
            'phone'
        ]);

        $validation = $this->validateData($data);

        if ($validation->fails()) {

            response()->json(['validation_errors' => $validation->errors()->all()]);
        }

        $hospital = new Hospital();

        $hospital->create($data);

        response()->json(['Hospital is created']);
    }

    public function update($id)
    {

        $hospital = Hospital::where('id', '=', (int)$id)->first();

        if (!is_null($hospital)) {

            $data = input()->all([
                'name',
                'address',
                'phone'
            ]);

            $validation = $this->validateData($data);

            if ($validation->fails()) {
                // handling errors
                response()->json(['validation_errors' => $validation->errors()->all()]);
            }

            $hospital->update($data);

            response()->json(['Hospital is updated']);

        }

        response()->json(['Hospital is not found']);

    }

    public function destroy($id)
    {
        $hospital = Hospital::where('id', '=', $id)->first();

        if (!is_null($hospital)) {
            if (count($hospital->users) > 0) {
                response()->json(['Тhe hospital is a workplace for (' . count($hospital->users) . ') doctors, please change their workplace before to delete the hospital']);
            }
            if ($hospital->delete()) {
                response()->json(['Hospital is deleted']);
            }
                response()->json(['Hospital is not deleted']);

        }
            response()->json(['Hospital is not found']);
    }

    protected function validateData($data): \Rakit\Validation\Validation
    {

        $validator = new Validator;

        return $validator->validate($data, [
            'name' => 'required|min:2|max:255|regex:/[A-Za-z0-9\-\\,.]+/',
            'address' => 'required|min:10|max:255|regex:/[A-Za-z0-9\-\\,.]+/',
            'phone' => 'required|numeric',
        ]);
    }

}
