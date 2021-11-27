<?php

namespace Tests\Feature;

use App\Models\Advertiser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlacklistTest extends TestCase
{

    public function test_basic_request()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_store_not_existed_advertiser(){
        $data=['input_line'=>'s7', 'advertiser_id'=>50];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['error_type'=>1]);
    }
    public function test_store_not_existed_site(){
        $data=['input_line'=>'s7000', 'advertiser_id'=>$this->advertiserId];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['error_type'=>3]);
    }
    public function test_store_not_existed_publisher(){
        $data=['input_line'=>'p7000', 'advertiser_id'=>$this->advertiserId];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['error_type'=>3]);
    }

    public function test_store_bad_input_line_extra_symbols(){
        $data=['input_line'=>'s7, p6, ps123', 'advertiser_id'=>$this->advertiserId];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['error_type'=>2]);
    }

    public function test_store_bad_input_line_no_commas(){
        $data=['input_line'=>'s7 p6', 'advertiser_id'=>$this->advertiserId];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['error_type'=>2]);
    }

    public function test_store_bad_input_line_empty_line(){
        $data=['input_line'=>'', 'advertiser_id'=>$this->advertiserId];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['error_type'=>2]);
    }


    public function test_store_single_item(){
        $data=['input_line'=>'s7', 'advertiser_id'=>$this->advertiserId];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['status'=>'Success']);
    }

    public function test_store_only_sites(){
        $data=['input_line'=>'s7, s6, s1', 'advertiser_id'=>$this->advertiserId];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['status'=>'Success']);
    }


    public function test_store_only_publishers(){
        $data=['input_line'=>'p1, p2, p3', 'advertiser_id'=>$this->advertiserId];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['status'=>'Success']);
    }

    public function test_store_sites_and_publishers(){
        $data=['input_line'=>'p1, p2, p3, s1, s2, s3', 'advertiser_id'=>$this->advertiserId];
        $response = $this->postJson('/api/blacklist',$data);

        $response->assertStatus(200)
            ->assertJson(['status'=>'Success']);
    }


    public function test_show_not_existed_advertiser(){
        $response = $this->get('/api/blacklist/500');

        $response->assertStatus(200)
            ->assertJson(['error_type'=>'1']);
    }

    public function test_show_advertiser(){
        $response = $this->get('/api/blacklist/'.$this->advertiserId);

        $response->assertStatus(200)
            ->assertJson(['status'=>'Success']);
    }


}
