<?php

namespace app\App\Controllers;

use app\App\Models\Hospital;
use app\App\Models\User;
use Rakit\Validation\Validator;

class UsersController extends BaseController
{

    public function index()
    {

        // Check if is set url query filter - byHospitalName, if yes - find school and get related users
        $this->byHospitalName();

        $user = User::query();

        if (input()->exists('type')) {

            $type = (int)input()->value('type');
            $user->where('type', '=', $type);

        }

        if (input()->exists('first_name')) {

            $first_name = input()->value('first_name');
            $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);

            $user->where('first_name', 'like', '%' . $first_name);

        }

        if (input()->exists('last_name')) {

            $last_name = input()->value('last_name');
            $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);

            $user->where('last_name', 'like', '%' . $last_name);

        }

        if (input()->exists('email')) {

            $email = input()->value('email');

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $user->where('email', '=', $email);

            } else {

                response()->json(['Email address is not valid format']);

            }

        }

        response()->json($user->get());

    }

    public function byHospitalName()
    {

        if (input()->exists('byHospitalName')) {

            $hospital = input()->value('byHospitalName');

            if (filter_var($hospital, FILTER_SANITIZE_STRING)) {

                $hospitalModel = Hospital::where('name', '=', filter_var($hospital, FILTER_SANITIZE_STRING))->first();

                !is_null($hospitalModel) ? response()->json($hospitalModel->users) : response()->json([]);

            } else {

                response()->json(['Email address is not valid format']);

            }

        }

    }

    public function show($id)
    {
        $user = User::where('id', '=', $id)->first();

        !is_null($user) ? response()->json($user) : response()->json([]);
    }

    public function store()
    {
        $data = input()->all([
            'email',
            'first_name',
            'last_name',
            'type',
            'workplace_id'
        ]);

        $validation = $this->validateData($data);

        if ($validation->fails()) {
            // handling errors
            response()->json(['validation_errors' => $validation->errors()->all()]);
        }

        $data = $this->validateDataPatientOrDoctor($data);

        $user = new User();

        $user->create($data);

        response()->json(['User is created']);

    }

    protected function validateData($data): \Rakit\Validation\Validation
    {

        $validator = new Validator;

        return $validator->validate($data, [
            'email' => 'required|min:5|max:255|regex:/[A-Za-z0-9\-\\,.]+/',
            'first_name' => 'required|min:2|max:255|regex:/[A-Za-z0-9\-\\,.]+/',
            'last_name' => 'required|min:2|max:255|regex:/[A-Za-z0-9\-\\,.]+/',
            'type' => 'required|numeric',
            'workplace_id' => 'numeric'
        ]);
    }

    /**
     * @param array $data
     * @return array
     */
    protected function validateDataPatientOrDoctor(array $data): array
    {
        if ((int)$data['type'] === 2 && !input()->exists('workplace_id')) {
            response()->json(['To create Doctor, please provide Workplace Id']);
        }

        if ((int)$data['type'] === 2 && input()->exists('workplace_id')) {

            $hospital = Hospital::where('id', '=', $data['workplace_id'])->first();

            if (is_null($hospital)) {
                response()->json(['Chosen Workplace not exist']);
            }
        }

        if ((int)$data['type'] === 1 && input()->exists('workplace_id')) {
            response()->json(['User type - Patient, can not have Workplace Id']);
        }
        return $data;
    }

    public function update($id)
    {
        $user = User::where('id', '=', (int)$id)->first();

        if (!is_null($user)) {

            $data = input()->all([
                'email',
                'first_name',
                'last_name',
                'type',
                'workplace_id'
            ]);

            $validation = $this->validateData($data);

            if ($validation->fails()) {

                response()->json(['validation_errors' => $validation->errors()->all()]);

            }

            $data = $this->validateDataPatientOrDoctor($data);

            $user->update($data);

            response()->json(['User is updated']);

        }

        response()->json(['Hospital is not found']);
    }

    public function destroy($id)
    {
        $user = User::where('id', '=', (int)$id)->first();

        if (!is_null($user)) {
            if ($user->delete()) {
                response()->json(['User is deleted']);
            }
            response()->json(['User is not deleted']);

        }
        response()->json(['Hospital is not found']);
    }

}
