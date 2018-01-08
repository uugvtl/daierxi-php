<?php
namespace App\Network\Modules\Manager\Generics\Creates\Legals\Area\District\Create;
use App\Globals\Legals\BaseLegal;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 8/1/18
 * Time: 13:59
 *
 * Class AppLegal
 * @package App\Network\Modules\Manager\Generics\Creates\Legals\Area\District\Create
 */
class AppLegal extends BaseLegal
{
    protected function run()
    {
        $aValidFields = ['name', 'short_name', 'city_code', 'zip_code', 'merger_name', 'pinyin', 'leaf'];
        $aValidMessage = [
            'message'   => [
                'name'              => $this->t('area_district', 'presence_name'),
                'short_name'        => $this->t('area_district', 'presence_short_name'),
                'city_code'         => $this->t('area_district', 'presence_city_code'),
                'zip_code'          => $this->t('area_district', 'presence_zip_code'),
                'merger_name'       => $this->t('area_district', 'presence_merger_name'),
                'pinyin'            => $this->t('area_district', 'presence_pinyin'),
                'leaf'              => $this->t('area_district', 'presence_leaf')
            ]
        ];

        $this->validation->add($aValidFields, new PresenceOf($aValidMessage));



        $aValidFields = ['parent_id', 'depth', 'lng', 'lat', 'leaf'];
        $aValidMessage = [
            'message'   => [
                'parent_id' => $this->t('area_district', 'numericality_parent_id'),
                'depth'     => $this->t('area_district', 'numericality_depth'),
                'lng'       => $this->t('area_district', 'numericality_lng'),
                'lat'       => $this->t('area_district', 'numericality_lat'),
                'leaf'      => $this->t('area_district', 'numericality_leaf')
            ]
        ];
        $this->validation->add($aValidFields, new Numericality($aValidMessage));

    }
}