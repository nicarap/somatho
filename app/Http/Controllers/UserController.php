<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\UserDTO;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Users/Index', [
            'users' => UserResource::collection(
                QueryBuilder::for(User::class)
                    ->with('roles')
                    ->allowedFilters([
                        'name',
                        'email',
                        AllowedFilter::partial('roles', 'roles.name')->ignore(null)
                    ])
                ->paginate()
                ->appends($request->query())
                ),
                'policies' => [
                    'create' => true,
                ]
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', User::class);

        return Inertia::render('Users/Create', [
            'roles' => Role::all(),
        ]);   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // $this->authorize('create', User::class);

        $user = $this->userService->create(UserDTO::from($request->all()));

        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);   
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
