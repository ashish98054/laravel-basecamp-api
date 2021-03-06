<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Forward;
use Belvedere\Basecamp\Sections\Traits\Recording;

class Forwards extends AbstractSection
{
    use Recording;

    /**
     * Index all forwards.
     *
     * @param  int  $page
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null)
    {
        $url = sprintf('buckets/%d/inboxes/%d/forwards.json', $this->bucket, $this->parent);

        $forwards = $this->client->get($url, [
            'query' => [
                'page' => $page,
            ]
        ]);

        return $this->indexResponse($forwards, Forward::class);
    }

    /**
     * Get a forward.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $forward = $this->client->get(
            sprintf('buckets/%d/inbox_forwards/%d.json', $this->bucket, $id)
        );

        return new Forward($this->response($forward));
    }

}
