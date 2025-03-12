@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenue sur votre Dashboard

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch("http://localhost:8002/api/user", {
            credentials: "include", // Permet d'envoyer les cookies de session
            headers: {
                "Accept": "application/json"
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Utilisateur non authentifié");
            }
            return response.json();
        })
        .then(user => {
            window.location.href = "/oauth/redirect"; // Déclenche la connexion OAuth auto
        })
        .catch(error => {
            console.log("Utilisateur non connecté à App2, authentification nécessaire.");
        });
    });
    </script>
@endsection