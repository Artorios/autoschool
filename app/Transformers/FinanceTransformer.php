<?php

namespace App\Transformers;

use App\Models\Training\School\AutoSchool;
use League\Fractal\TransformerAbstract;

class FinanceTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param AutoSchool $autoSchool
     * @return array
     */
    public function transform(AutoSchool $autoSchool)
    {
        $orders = [];
//        foreach ($autoSchool->autoschoolGroups()->get() as $autoSchoolGroup) {
//            foreach ($autoSchoolGroup->users()->get() as $user) {
//                foreach ($user->orders as $order) {
//                    $orders[] = [
//                        'id'         => $autoSchool->id,
//                        'autoschool' => [
//                            'id'   => $autoSchool->id,
//                            'name' => $autoSchool->title,
//                            'group' => $autoSchoolGroup->name
//                        ],
//                        'user'       => [
//                            'name' => $user->name
//                        ],
//                        'order'      => $order
//                    ];
//                }
//            }
//        }
        return $orders;
    }
}
