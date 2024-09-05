<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

class SearchController extends AppController
{
    /**
     * Universal search function to find entities by description.
     *
     * @param string $searchTerm The search term to look for.
     * @return \Cake\Http\Response|null
     */

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization(['index']);
    }

    public function index($searchTerm)
    {
        $results = [];

        // Search in the Journal entity
        $journalTable = TableRegistry::getTableLocator()->get('Journal');
        $journal = $journalTable->find()
            ->select(['id', 'title', 'content'])
            ->where(['content LIKE' => '%' . $searchTerm . '%'])
            ->all();
        foreach ($journal as $journalEntry) {
            $results[] = [
                'entity' => 'Journal',
                'id' => $journalEntry->id,
                'title' => $journalEntry->title,
                'content' => strip_tags($journalEntry->content)
            ];
        }

        // Search in other entities...
        // Add similar code for each entity you want to search in

        // Pass the search results to the view
        $this->set('results', $results);
        $this->set('searchTerm', $searchTerm);
    }
}
