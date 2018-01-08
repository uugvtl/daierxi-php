<?php
namespace App\Network\Legals\Area;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 16:04
 *
 * Class StreetLegal
 * @package App\Network\Legals\Area
 */
class StreetLegal extends BaseLegal
{
    protected function run()
    {
        $aValidFields = ['street_name'];
        $aValidMessage = [
            'message'   => [
                'street_name'       => $this->t('area_street', 'presence_street_name')
            ]
        ];

        $this->validation->add($aValidFields, new PresenceOf($aValidMessage));



        $aValidFields = ['district_id'];
        $aValidMessage = [
            'message'   => [
                'district_id'   => $this->t('area_district', 'numericality_id')
            ]
        ];
        $this->validation->add($aValidFields, new Numericality($aValidMessage));
    }
}