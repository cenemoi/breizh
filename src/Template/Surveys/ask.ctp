<div class="users form large-9 medium-8 columns content">
    <?php if (!$heAsk) { ?>
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= __('Merci de remplir les champs ci dessous et de répondre aux questions') ?></legend>
            <?php
                echo $this->Form->input('email', ['label' => 'E-mail']);
                echo $this->Form->input('firstname', ['label' => 'Prénom', 'type' => 'text']);
                echo $this->Form->input('lastname', ['label' => 'Nom', 'type' => 'text']);

                $label = [
                    "En JavaScript, Est-ce que 100==='100' ? ",
                    "Dans AngularJS, est ce qu'il y a une notion d'héritage ?",
                    "En java, toutes les variables héritent de java.lang.Object ?",
                    "La méthode HTTP de modification est POST:",
                    "En ruby, le '!' a-t-il son utilité ?",
                    "Avec Elasticsearch, on peut faire des aggregations géoraphiques uniquement avec des formes circulaires ?",
                    "En Sql, 'HAVING' s'utilise toujours avec un 'GROUP BY'",
                    "Avec Git, est ce qu'on commit sur le serveur ?",
                    "En Android, on peut avoir des parties d'écran indépendantes avec différents cycles de vie ",
                    "Avec Jira, peut-on nativement visualiser le contenu d'un commit Git dans un ticket JIRA si l'application est reliée au dépôt ?"
                ];

                foreach ($label as $key => $question) {
                    echo $this->Form->label($question, $key+1 . ') ' . $question);
                    echo $this->Form->radio(
                        'question_' . $key,
                        [
                            ['value' => true, 'text' => 'Oui'],
                            ['value' => false, 'text' => 'Non'],
                        ],
                        [
                            'label' => true,
                        ]
                    );
                }
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    <?php } else { ?>
        <b><?= $user['firstname'] . ' ' . $user['lastname'] ?></b>, ton score est de :
        <b><?= $user['score'] ?></b>, merci pour ta participation.
        <br/>
        Tu seras informé par email si tu as gagné ta place pour la Devops à Paris qui se déroulera le <?= date('Y-M-d') ?>
        <br/>
        Tu peux visiter le site de netapsys à cette adresse :
        <a target="_blank" href="http://www.netapsys.fr/">Netapsys</a>
    <?php } ?>
</div>
