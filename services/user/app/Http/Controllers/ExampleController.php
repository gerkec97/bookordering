<?php

namespace App\Http\Controllers;

use Assert\LazyAssertionException;
use EmeraldIsland\Domain\Domain\Exceptions\UserAlreadyExistsException;
use EmeraldIsland\Domain\Domain\Exceptions\UserNotFoundException;
use EmeraldIsland\Domain\Domain\Repositories\UserRepositoryInterface;
use EmeraldIsland\Domain\Domain\Services\UserServiceInterface;
use EmeraldIsland\Infrastructure\Persistence\Doctrine\Repositories\Domain\UserRepository;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function get(Request $request, $username)
    {
        try {
            $user = app(UserServiceInterface::class)->getByUserName($username);
            // transform
            $data = ['username' => $user->getUserName(), 'first_name' => $user->getFirstName(), 'last_name' => $user->getLastName(), 'email' => $user->getEmail()];
            return response()->json($data);
        } catch (UserNotFoundException $ex) {
            return response()->json(['errors' =>[$ex->getMessage()]], 400);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>['Error while processing request']], 500);
        }
    }

    public function register(Request $request)
    {
        $data = [
            'username' => $request->json()->get('username'),
            'first_name' => $request->json()->get('first_name'),
            'last_name' => $request->json()->get('last_name'),
            'email' => $request->json()->get('email')
        ];

        try {
            app(UserServiceInterface::class)->createUser($data);
            return response()->json($data);
        } catch (UserAlreadyExistsException $ex) {
            return response()->json(['errors' => [$ex->getMessage()]], 400);
        } catch (LazyAssertionException $ex) {
            return response()->json(['errors' =>[$ex->getMessage()]], 400);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>[$ex->getMessage() . 'Error while processing request']], 500);
        }
    }

    public function unregister(Request $request, $username)
    {
        try {
            app(UserServiceInterface::class)->deleteUser($username);
            return response(null,204);
        } catch (UserNotFoundException $ex) {
            return response()->json(['errors' =>[$ex->getMessage()]], 400);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>['Error while processing request']], 500);
        }
    }

    public function update(Request $request, $username)
    {
        $data = [
            'first_name' => $request->json()->get('first_name'),
            'last_name' => $request->json()->get('last_name'),
            'email' => $request->json()->get('email')
        ];

        try {
            app(UserServiceInterface::class)->updateUser($username, $data);

            return response()->json($data);
        } catch (UserNotFoundException $ex) {
            return response()->json(['errors' => [$ex->getMessage()]], 400);
        } catch (LazyAssertionException $ex) {
            return response()->json(['errors' =>[$ex->getMessage()]], 400);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' =>[$ex->getMessage(), 'Error while processing request']], 500);
        }

    }

    public function listOrders(Request $request, $username)
    {

    }

    public function index(Request $request)
    {
        echo '<pre>';
//?        $user = new \EmeraldIsland\Domain\Domain\Entities\User('gkOne',
//            'ger', 'kec', 'gerrit.keck@gmail.com');
//        $userId = app(UserRepositoryInterface::class)->save($user);
//        app(UserRepositoryInterface::class)->save($user);
        echo '</pre>';
    }

    
    //
}
