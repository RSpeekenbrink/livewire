<?php

namespace Livewire\Features\SupportTesting\Tests;

use Livewire\Component;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

class TestableLivewireCanAssertRedirectToRouteUnitTest extends \Tests\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Route::get('foo', function () {
            return true;
        })->name('foo');
    }

    /** @test */
    function can_assert_a_redirect_to_a_route()
    {
        $component = Livewire::test(RedirectComponent::class);

        $component->call('performRedirect');

        $component->assertRedirectToRoute('foo');
    }

    /** @test */
    function can_detect_failed_redirect()
    {
        $component = Livewire::test(RedirectComponent::class);

        $this->expectException(\PHPUnit\Framework\AssertionFailedError::class);

        $component->assertRedirectToRoute('foo');
    }
}

class RedirectComponent extends Component
{
    function performRedirect()
    {
        $this->redirectRoute('foo');
    }

    function render()
    {
        return view('null-view');
    }
}
