<?php

namespace Tests\Unit;

use App\Fruta;
use Tests\TestCase;

class UpdateUnitTest extends TestCase
{
    /** @test */
    public function update_Test()
    {
        $fruta = new Fruta();
        $fruta->nombre = "fruta15";
        $fruta->size = "pequeño";
        $fruta->save();

        $this->post('frutas/'.$fruta->id, $fruta->toArray());

        $this->assertDatabaseHas('frutas',['id'=> $fruta->id , 'nombre' => 'fruta15']);
        $this->assertDatabaseHas('frutas',['id'=> $fruta->id , 'size' => 'pequeño']);
    }
}
