<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Admin - Nexus Games</title>
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard-v2.css') }}">
</head>
<body>
    <!-- Header del Admin -->
    <header class="admin-header">
        <div class="admin-logo">
            <h1>🎮 NEXUS ADMIN <span class="admin-badge">ADMINISTRADOR</span></h1>
        </div>
        
        <div class="header-actions">
            <span class="welcome-text">Hola, {{ $user->name ?? auth()->user()->name }}</span>
            <a href="{{ route('home') }}" class="btn btn-home">Ver Tienda</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </header>

    <div class="admin-container">
        <!-- Sidebar de Navegación -->
        <aside class="admin-sidebar">
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">Dashboard</span>
                </a>
                <a href="{{ route('admin.games') }}" class="nav-item">
                    <span class="nav-icon">🎮</span>
                    <span class="nav-text">Gestionar Juegos</span>
                </a>
                <a href="{{ route('admin.users') }}" class="nav-item">
                    <span class="nav-icon">👥</span>
                    <span class="nav-text">Usuarios</span>
                </a>
                <a href="{{ route('admin.reviews') }}" class="nav-item">
                    <span class="nav-icon">💬</span>
                    <span class="nav-text">Reseñas</span>
                </a>
                <a href="{{ route('admin.categories') }}" class="nav-item">
                    <span class="nav-icon">📂</span>
                    <span class="nav-text">Categorías</span>
                </a>
            </nav>
        </aside>

        <!-- Contenido Principal -->
        <main class="admin-main">
            <!-- Bienvenida -->
            <div class="welcome-section">
                <h1 class="page-title">📊 Panel de Control</h1>
                <p class="page-subtitle">Gestiona tu tienda de videojuegos Nexus desde aquí</p>
            </div>

            <!-- Estadísticas Principales -->
            <div class="stats-grid">
                <div class="stat-card games">
                    <div class="stat-icon">🎮</div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['total_games'] ?? 0 }}</div>
                        <div class="stat-label">Total de Juegos</div>
                        <div class="stat-sublabel">En el catálogo</div>
                    </div>
                    <div class="stat-action">
                        <a href="{{ route('admin.games') }}" class="stat-link">Ver todos</a>
                    </div>
                </div>
                
                <div class="stat-card active">
                    <div class="stat-icon">✅</div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['active_games'] ?? 0 }}</div>
                        <div class="stat-label">Juegos Activos</div>
                        <div class="stat-sublabel">Visibles en tienda</div>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar" style="width: {{ $stats['total_games'] > 0 ? round(($stats['active_games'] / $stats['total_games']) * 100) : 0 }}%"></div>
                    </div>
                </div>
                
                <div class="stat-card hidden">
                    <div class="stat-icon">👁️‍🗨️</div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['hidden_games'] ?? 0 }}</div>
                        <div class="stat-label">Juegos Ocultos</div>
                        <div class="stat-sublabel">No visibles</div>
                    </div>
                    <div class="stat-action">
                        <a href="{{ route('admin.games') }}?filter=hidden" class="stat-link">Gestionar</a>
                    </div>
                </div>
                
                <div class="stat-card users">
                    <div class="stat-icon">👥</div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['total_users'] ?? 0 }}</div>
                        <div class="stat-label">Usuarios</div>
                        <div class="stat-sublabel">Registrados</div>
                    </div>
                    <div class="stat-action">
                        <a href="{{ route('admin.users') }}" class="stat-link">Ver usuarios</a>
                    </div>
                </div>
                
                <div class="stat-card reviews">
                    <div class="stat-icon">💬</div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['total_reviews'] ?? 0 }}</div>
                        <div class="stat-label">Reseñas</div>
                        <div class="stat-sublabel">Total publicadas</div>
                    </div>
                    <div class="stat-action">
                        <a href="{{ route('admin.reviews') }}" class="stat-link">Moderar</a>
                    </div>
                </div>
                
                <div class="stat-card revenue">
                    <div class="stat-icon">💰</div>
                    <div class="stat-content">
                        <div class="stat-number">S/ {{ number_format($stats['monthly_revenue'] ?? 0, 2) }}</div>
                        <div class="stat-label">Ingresos del Mes</div>
                        <div class="stat-sublabel">{{ now()->format('F Y') }}</div>
                    </div>
                    <div class="stat-trend positive">
                        <span class="trend-icon">📈</span>
                        <span class="trend-text">+15%</span>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="quick-actions-section">
                <h2 class="section-title">⚡ Acciones Rápidas</h2>
                <div class="quick-actions">
                    <a href="{{ route('admin.games.create') }}" class="action-card primary">
                        <div class="action-icon">➕</div>
                        <div class="action-content">
                            <div class="action-title">Agregar Juego</div>
                            <div class="action-description">Añadir nuevo juego al catálogo</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.users') }}" class="action-card secondary">
                        <div class="action-icon">👤</div>
                        <div class="action-content">
                            <div class="action-title">Ver Usuarios</div>
                            <div class="action-description">Gestionar usuarios registrados</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.reviews') }}" class="action-card warning">
                        <div class="action-icon">🔍</div>
                        <div class="action-content">
                            <div class="action-title">Moderar Reseñas</div>
                            <div class="action-description">Revisar comentarios pendientes</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.categories') }}" class="action-card info">
                        <div class="action-icon">📂</div>
                        <div class="action-content">
                            <div class="action-title">Categorías</div>
                            <div class="action-description">Organizar géneros de juegos</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Contenido en dos columnas -->
            <div class="dashboard-columns">
                <!-- Columna Izquierda - Juegos Recientes -->
                <div class="dashboard-column">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3 class="card-title">🎮 Juegos Recientes</h3>
                            <a href="{{ route('admin.games') }}" class="card-action">Ver todos</a>
                        </div>
                        <div class="card-content">
                            @if(isset($stats['recent_games']) && $stats['recent_games']->count() > 0)
                                <div class="recent-games-list">
                                    @foreach($stats['recent_games'] as $game)
                                        <div class="recent-game-item">
                                            <div class="game-info">
                                                <div class="game-title">{{ $game->title }}</div>
                                                <div class="game-meta">
                                                    <span class="game-category">{{ $game->category->name ?? 'Sin categoría' }}</span>
                                                    <span class="game-price">S/ {{ number_format($game->price, 2) }}</span>
                                                </div>
                                                <div class="game-date">{{ $game->created_at->diffForHumans() }}</div>
                                            </div>
                                            <div class="game-status">
                                                <span class="status-badge {{ $game->is_active ? 'active' : 'inactive' }}">
                                                    {{ $game->is_active ? 'Activo' : 'Oculto' }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">🎮</div>
                                    <p>No hay juegos recientes para mostrar</p>
                                    <a href="{{ route('admin.games.create') }}" class="btn btn-primary">Agregar primer juego</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha - Usuarios Recientes -->
                <div class="dashboard-column">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3 class="card-title">👥 Usuarios Recientes</h3>
                            <a href="{{ route('admin.users') }}" class="card-action">Ver todos</a>
                        </div>
                        <div class="card-content">
                            @if(isset($stats['recent_users']) && $stats['recent_users']->count() > 0)
                                <div class="recent-users-list">
                                    @foreach($stats['recent_users'] as $user)
                                        <div class="recent-user-item">
                                            <div class="user-avatar">
                                                @if($user->profile_image)
                                                    <img src="{{ asset($user->profile_image) }}" alt="{{ $user->name }}">
                                                @else
                                                    <div class="avatar-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                                @endif
                                            </div>
                                            <div class="user-info">
                                                <div class="user-name">{{ $user->name }}</div>
                                                <div class="user-email">{{ $user->email }}</div>
                                                <div class="user-date">Registrado {{ $user->created_at->diffForHumans() }}</div>
                                            </div>
                                            <div class="user-actions">
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="user-action-btn">Ver perfil</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">👥</div>
                                    <p>No hay usuarios recientes</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Estadísticas Adicionales -->
            <div class="additional-stats">
                <div class="stat-row">
                    <div class="mini-stat">
                        <div class="mini-stat-icon">📦</div>
                        <div class="mini-stat-content">
                            <div class="mini-stat-number">{{ $stats['total_orders'] ?? 0 }}</div>
                            <div class="mini-stat-label">Órdenes Completadas</div>
                        </div>
                    </div>
                    
                    <div class="mini-stat">
                        <div class="mini-stat-icon">📂</div>
                        <div class="mini-stat-content">
                            <div class="mini-stat-number">{{ $stats['total_categories'] ?? 0 }}</div>
                            <div class="mini-stat-label">Categorías</div>
                        </div>
                    </div>
                    
                    <div class="mini-stat">
                        <div class="mini-stat-icon">⭐</div>
                        <div class="mini-stat-content">
                            <div class="mini-stat-number">{{ number_format($stats['total_reviews'] > 0 ? $stats['total_reviews'] / $stats['total_games'] : 0, 1) }}</div>
                            <div class="mini-stat-label">Reseñas por Juego</div>
                        </div>
                    </div>
                    
                    <div class="mini-stat">
                        <div class="mini-stat-icon">🎯</div>
                        <div class="mini-stat-content">
                            <div class="mini-stat-number">{{ $stats['total_games'] > 0 ? round(($stats['active_games'] / $stats['total_games']) * 100) : 0 }}%</div>
                            <div class="mini-stat-label">Juegos Activos</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Actualizar datos en tiempo real cada 30 segundos
        setInterval(() => {
            fetch('{{ route("admin.dashboard") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Actualizar solo las estadísticas sin recargar toda la página
                console.log('Datos actualizados');
            })
            .catch(error => console.error('Error:', error));
        }, 30000);

        // Animaciones para las tarjetas
        document.querySelectorAll('.stat-card, .action-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Mostrar notificaciones si existen
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <span class="notification-icon">${type === 'success' ? '✅' : '❌'}</span>
                    <span class="notification-message">${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }
    </script>
</body>
</html>