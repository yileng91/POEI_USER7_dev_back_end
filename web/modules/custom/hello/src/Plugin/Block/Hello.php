<?php
/**
 * Created by PhpStorm.
 * User: POE9
 * Date: 05/11/2019
 * Time: 10:06
 */
namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 *  Provides a hello block
 *  @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello!")
 * )
 */

class Hello extends BlockBase{
    /**
     * Implements Drupal\Core\Block\BlockBase::build().
     */
    public function build(){

        //$date = DrupalDateTime::createFromFormat('j-M-Y', '20-Jul-2019');
        //$date = \Drupal::service('date.formatter');

        //$node = Node::load(2100);
        //$start_date = $node->field_date->start_date;
        /*$formatted = \Drupal::service('date.formatter')->format(
            \Drupal::service('datetime.time')->getCurrent(), 'custom', 'Y-m-d H:i:s P'
        );
        $build = array('#markup' => $this->t('Welcome %time');

        return $build;*/
        $date_formatter = \Drupal::service('date.formatter');
        $time = \Drupal::service('datetime.time')->getCurrentTime();
        $user_name = \Drupal::currentUser()->getDisplayName();
        return [
            '#markup' => $this->t('Welcome. %name It is %time.', [
                '%name' => $user_name,
                '%time' => $date_formatter->format($time, 'custom', 'H:i s\s'),

            ]),
            /* cache tous les utilisateurs soit pas de clé de cache */
            '#cache' => [
                'max-age' => '0',
            ]
            /*cache par utilisateur */
            /*'#cache' => [
                'keys' => ['hello_block'],
                'contexts' => ['user'],
                'max-age' => '1000',
                ],*/
        ];
    }
}