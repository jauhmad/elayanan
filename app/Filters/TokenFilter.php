<?php namespace App\Filters;
//https://ilmucoding.com/middleware-filters-codeigniter-4/ 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class TokenFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session('id')) // saya hanya membuat sederhana saja. silahkan kembangkan di kemudian hari
        {
            return redirect()->to('/login');
        }
        // Do something here
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}