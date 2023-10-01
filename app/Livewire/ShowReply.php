<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;

class ShowReply extends Component
{
    public Reply $reply;
    public $body = '';
    public $is_creating = false;
    public $is_editing = false;

    public function updatedIsCreating()
    {
        $this->is_editing = false;
        $this->body = '';
    }

    public function updatedIsEditing() //se puede recibir una variable
    {
        $this->is_creating = false;
        $this->body = $this->reply->body;
    }

    public function updateReply()
    {
        //validar
        $this->validate(['body' => 'required']);

        //update
        $this->reply->update(['body' => $this->body]);

        //refresh
        $this->is_editing = false;
    }

    public function postChild()
    {
        if(!is_null($this->reply->reply_id)) return;    //para no permitir el nivel 3 de respuestas

        //validar
        $this->validate(['body' => 'required']);

        //crear
        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body
        ]);

        //refresh
        $this->is_creating = false;
        $this->body = '';
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
