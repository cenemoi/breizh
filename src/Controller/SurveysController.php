<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class SurveysController extends AppController
{
    /**
     * Ask method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
	public function ask($param = null ) {
	 if( $param == 'toss') {
           echo 'Bienvenue Vincent, le winner est : ';
           $usersTable = TableRegistry::get('Users');
           $users = $usersTable->find('all', ['order' => ['score' => 'desc']]);
           $users = $users->first();
           $bestScore = $users['score'];
           $users = $usersTable->findAllByScore($bestScore);
           $users = $users->toArray();
           $userIds = Hash::extract($users, '{n}.id');
           $userIds = array_values($userIds);
           $winner = array_rand($userIds);
           $user = $usersTable->get($userIds[$winner]);
           echo '<br/><br/><b>Email :</b> '.$user->email;
           echo '<br/><b>Prénom :</b> '.$user->firstname;
           echo '<br/><b>Nom :</b> '.$user->lastname;
           echo '<br/><b>Score :</b> '.$user->score;
           die;
        }

        $heAsk = false;
        $accessquestions = false;
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            if (empty($this->request->data('question_0'))) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $accessquestions = true;
                    $this->request->data = $user;
                }
            }
        } else if ($this->request->is('put')) {
            $users = TableRegistry::get('Users');

            $user = $users->get($this->request->data('id')); // $this->Users->find('first', [ 'email' => $this->request->data('email') ]);
            if( $user['score'] != 0 ) {
                $this->redirect('/');
            } else {
	       $score = 0;
               $responses = [
                'question_0' => 0,
                'question_1' => 1,
                'question_2' => 0,
                'question_3' => 0,
                'question_4' => 1,
                'question_5' => 0,
                'question_6' => 0,
                'question_7' => 0,
                'question_8' => 1,
                'question_9' => 0
              ];

              foreach ($responses as $key => $value) {
                if ( $this->request->data[$key] != '' && $this->request->data[$key] == $value) {
                    $score++;
                }
              }
              $user->score = $score;

              if ($users->save($user)) {
                $heAsk = true;
              }
           }
        }
        $this->set(compact('heAsk', 'accessquestions'));
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

}
