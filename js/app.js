document.addEventListener('DOMContentLoaded', function() {
    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Dashboard stats (simulado - en producción sería con AJAX)
    if (document.getElementById('clientes-count')) {
        // Simular carga de datos
        setTimeout(() => {
            document.getElementById('clientes-count').textContent = '24';
            // Otros contadores...
            
            // Cargar cotizaciones recientes
            const quotesTable = document.getElementById('recent-quotes');
            if (quotesTable) {
                const quotes = [
                    {id: 1001, cliente: 'Juan Pérez', vehiculo: 'Toyota Corolla 2020', total: '$2,500', estado: 'Aprobada'},
                    {id: 1002, cliente: 'María Gómez', vehiculo: 'Honda Civic 2018', total: '$1,800', estado: 'Pendiente'},
                    {id: 1003, cliente: 'Carlos Ruiz', vehiculo: 'Nissan Sentra 2019', total: '$3,200', estado: 'Completada'}
                ];
                
                quotes.forEach(quote => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${quote.id}</td>
                        <td>${quote.cliente}</td>
                        <td>${quote.vehiculo}</td>
                        <td>${quote.total}</td>
                        <td><span class="badge ${getStatusBadgeClass(quote.estado)}">${quote.estado}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">Ver</button>
                        </td>
                    `;
                    quotesTable.appendChild(row);
                });
            }
        }, 800);
    }

    // Login form handling
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Aquí iría la validación del formulario
            this.submit();
        });
    }
});

function getStatusBadgeClass(status) {
    switch(status.toLowerCase()) {
        case 'aprobada': return 'bg-success';
        case 'pendiente': return 'bg-warning text-dark';
        case 'completada': return 'bg-primary';
        default: return 'bg-secondary';
    }
}

// Función para cargar clientes via AJAX
function loadClientes() {
    if (window.location.pathname.includes('clientes.html')) {
        fetch('php/clientes.php?action=list')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('clientes-table');
                if (tableBody && data.success) {
                    tableBody.innerHTML = '';
                    data.clientes.forEach(cliente => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${cliente.id_cliente}</td>
                            <td>${cliente.Nombre}</td>
                            <td>${cliente.Telefono}</td>
                            <td>${cliente.Correo}</td>
                            <td>${cliente.Fecha_Registro}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" onclick="editCliente(${cliente.id_cliente})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteCliente(${cliente.id_cliente})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }
}