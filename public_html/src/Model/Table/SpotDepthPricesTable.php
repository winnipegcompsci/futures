<?php
namespace App\Model\Table;

use App\Model\Entity\SpotDepthPrice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SpotDepthPrices Model
 */
class SpotDepthPricesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('spot_depth_prices');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Exchanges', [
            'foreignKey' => 'exchange_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->allowEmpty('timestamp');
            
        $validator
            ->allowEmpty('asks');
            
        $validator
            ->allowEmpty('bids');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['exchange_id'], 'Exchanges'));
        return $rules;
    }
}
