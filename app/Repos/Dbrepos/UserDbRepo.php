<?php namespace App\Repos\Dbrepos;

use App\User;

/**
 * Class UserDbRepo
 * @package App\Repos\Dbrepos
 */
class UserDbRepo {

    protected $user;

    /**
     * @param User $user
     */
    public function __construct( User $user )
    {
        $this->user = $user;
    }

    public function create( $requestData )
    {
        $status = false;

        try
        {
            $status = $this->user->create( [
                'name' => $requestData['name'],
                'first_name' => $requestData['first_name'],
                'last_name' => $requestData['last_name'],
                'email' => $requestData['email'],
                'password' => bcrypt( $requestData['password'] ),
                'type' => $requestData['type'],
                'status' => $requestData['status']
            ] );
        }
        catch ( \Exception $e )
        {
            $status = false;
        }
        return $status;
    }


    public function findByUsernameOrCreate( $user )
    {
        $name = ($user->getNickname() != '') ? $user->getNickname() : $user->getName();
        $email = $user->getEmail();
        if ( $user && $email == "" && $name != "" )
        {
            $tempUser = User::where( 'email', 'guest@noemail.com' )->first();
            $tempUser->name = $name;
            $tempUser->save();

            return $tempUser;
        }

        $existingUser = User::where( 'email', $email )->first();
        if ( $existingUser )
        {
            return $existingUser;
        }
        return User::firstOrCreate( [
            'name' => $name,
            'email' => $email,
            'type' => 4
        ] );
    }


    /**
     * @param $id
     * Get User by ID
     */
    public function getUserInfoById( $id )
    {
        try
        {
            return $this->user->with( 'comments', 'thread' )->find( $id );
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }

    public function getPaginatedUsers( $limit = 10 )
    {
        try
        {
            return $this->user->paginate( $limit );
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }

    public function update( $id, $requestData )
    {
        $status = false;

        try
        {
            $user = $this->user->find( $id );

            $user->name = $requestData['name'];
            $user->first_name = $requestData['first_name'];
            $user->last_name = $requestData['last_name'];
            $user->email = $requestData['email'];
            $user->type = $requestData['type'];
            $user->status = $requestData['status'];
            $status = $user->save();
        }
        catch ( \Exception $e )
        {
            $status = false;
        }
        return $status;


    }

    public function delete( $id )
    {
        try
        {
            return $this->user->where( 'id', $id )->delete();
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }
}