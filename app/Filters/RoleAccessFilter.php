<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userRole = $session->get('user_role');
        $userId = $session->get('user_id');

        if (empty($userRole)) {
            return redirect()->to('/')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        $path = trim($request->getUri()->getPath(), '/');
        $requiredRole = $this->resolveRequiredRole($path);

        if ($requiredRole === null || $requiredRole === $userRole) {
            return;
        }

        if ($requiredRole === 'admin') {
            return redirect()->to($userId ? '/profil/' . $userId : '/dashboard')->with('error', 'Accès réservé à l\'administrateur.');
        }

        return redirect()->to($userRole === 'admin' ? '/dashboard' : '/')->with('error', 'Accès réservé aux utilisateurs.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }

    private function resolveRequiredRole(string $path): ?string
    {
        if ($path === '') {
            return null;
        }

        if (preg_match('#^(dashboard|codes|sports)(/|$)#', $path)) {
            return 'admin';
        }

        if ($path === 'regimes' || preg_match('#^regimes/(add|edit|update|delete)(/|$)#', $path)) {
            return 'admin';
        }

        if ($path === 'regimes/suggestions' || $path === 'regimes/achat') {
            return 'user';
        }

        if (preg_match('#^(profil|porte_monnaie|gold|monRegime|objectif)(/|$)#', $path)) {
            return 'user';
        }

        if (preg_match('#^regimes(/|$)#', $path)) {
            return 'admin';
        }

        return null;
    }
}