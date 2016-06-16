<div class="users form large-9 medium-8 columns content">
    <?php if (!$heAsk) { ?>
        <?= $this->Form->create($user) ?>
        <fieldset><?php
	  if ($accessquestions) {
		$text = __('Valider mes réponses');
                echo '<legend>Merci de répondre aux questions</legend>';
                echo $this->Form->input('id');
                $label = [
                    "En JavaScript, Est-ce que 100==='100' ? ",
                    "Dans AngularJS, existe-t-il une notion d'héritage ?",
                    "En Java, toutes les variables héritent-elles de java.lang.Object ?",
                    "La méthode HTTP de modification est-elle POST ?",
                    "En Ruby, le '!' a-t-il son utilité ?",
                    "Avec Elasticsearch, on peut faire des agrégations géographiques uniquement avec des formes circulaires",
                    "En SQL, 'HAVING' s'utilise toujours avec un 'GROUP BY'",
                    "Avec Git, est-ce qu'on commit sur le serveur ?",
                    "En Android, peut-on avoir des parties d'écran indépendantes avec différents cycles de vie ?",
                    "Avec Jira, peut-on nativement visualiser le contenu d'un commit Git dans un ticket JIRA si l'application est reliée au dépôt ?"
                ];

                foreach ($label as $key => $question) {
                    echo $this->Form->label($question, $key + 1 . ') ' . $question);
                    echo $this->Form->radio(
                        'question_' . $key,
                        [
                            ['value' => '1', 'text' => 'Oui'],
                            ['value' => '0', 'text' => 'Non'],
                        ],
                        [
                            'label' => true,
                        ]
                    );
                }
            } else {
                echo '<legend>Merci de remplir les champs ci-dessous pour accèder aux questions</legend>';
                echo $this->Form->input('email', ['label' => 'E-mail']);
                echo $this->Form->input('firstname', ['label' => 'Prénom de ton billet', 'type' => 'text']);
                echo $this->Form->input('lastname', ['label' => 'Nom de ton billet', 'type' => 'text']);
            	$text = __('Valider mes informations');
	    }
            ?>
        </fieldset>
	<?= $this->Form->button( $text ) ?>
        <?= $this->Form->end() ?>
    <?php } else { ?>
 	<b><?= $user['firstname'] . ' ' . $user['lastname'] ?></b>, merci de ta participation à ce QCM.<br/>
        Dépouillement vendredi après-midi sur notre stand<br/><br/>
        <?php
            if ($user['score'] <= 6) {
                echo "Bon, on va être direct ... ça va être compliqué de gagner la montre connectée !
                       Ouvre tes horizons techniques, profites bien des conférences pour prendre plein d'informations,
                    et reviens nous voir d'ici la fin du BreizhCamp, avec grand plaisir !";
            }

            if ($user['score'] == 7 || $user['score'] == 8) {
                echo "Résultat correct, mais probablement un peu juste pour gagner la montre connectée. Continue à bien profiter de la manifestation, et repasse nous voir, avec grand plaisir !";
            }


            if ($user['score'] == 9) {
                echo "Hé, bon score ! Mais une petite erreur pourrait t'être fatale ... Repasse quand tu veux et notamment pour le dépouillement des résultats, tu n'es pas à l'abri d'une bonne surprise !";
            }

            if ($user['score'] == 10) {
                echo "Ok, bravo ! Tu es totalement dans l'esprit du BreizhCamp ! Tu as toutes tes chances de gagner la montre connectée, donc passe sur le stand au moment du dépouillement";
            }
        ?>
        <br/>
        <br/>

	<?php
	echo '<div style="width:100%;text-align:center">';
                echo $this->Html->image('/webroot/img/kakemono.jpg', [ 'alt' => 'Kakémono', 'style' => 'width: 400px;']);
        echo '</div>';
	?>
    <?php } ?>
	<br/>
	<br/>
</div>
