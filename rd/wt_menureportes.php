<style>
/* Estilos encapsulados solo para el menú de reportes */
.menu-reportes-container {
    margin-top: 30px;
    padding: 20px 0;
    background-color: #f8f9fa;
}

.menu-reportes-container h5 {
    color: #333;
    font-weight: 600;
    margin-bottom: 20px;
}

.menu-reportes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    padding: 0 15px;
}

.menu-reportes-item {
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    min-height: 140px;
    cursor: pointer;
}

.menu-reportes-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.menu-reportes-item img {
    width: 60px;
    height: 60px;
    margin-bottom: 12px;
    object-fit: contain;
}

.menu-reportes-item p {
    margin: 0;
    font-size: 13px;
    font-weight: 600;
    color: #333;
    text-align: center;
    line-height: 1.3;
}

/* Modal de gastos - estilos específicos */
.modal-gastos .form-header {
    padding: 15px 20px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    color: white;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-gastos .form-ingreso { 
    background-color: #28a745; 
}

.modal-gastos .form-egreso { 
    background-color: #dc3545; 
}

.modal-gastos .nav-tabs {
    border-bottom: 2px solid #dee2e6;
}

.modal-gastos .nav-tabs .nav-link {
    font-weight: 500;
    color: #495057;
}

.modal-gastos .nav-tabs .nav-link.active {
    color: #0d6efd;
    border-bottom: 3px solid #0d6efd;
}

/* Tabla de saldo */
.tabla-saldo-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.saldo-actual-display {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.saldo-actual-display h5 {
    color: white;
    font-size: 1.8rem;
    margin: 0;
    font-weight: 700;
}

.tabla-saldo-container table {
    font-size: 0.9rem;
}

.tabla-saldo-container table thead {
    background-color: #343a40;
    color: white;
}

.tabla-saldo-container table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Offcanvas mejorado */
.offcanvas-gastos .offcanvas-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.offcanvas-gastos .offcanvas-header .btn-close {
    filter: brightness(0) invert(1);
}

.offcanvas-gastos .zoomable {
    border: 3px solid #e9ecef;
    transition: transform 0.3s ease;
}

.offcanvas-gastos .zoomable:hover {
    transform: scale(1.02);
}

/* Responsive */
@media (max-width: 576px) {
    .menu-reportes-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .menu-reportes-item {
        min-height: 120px;
        padding: 15px;
    }
    
    .menu-reportes-item img {
        width: 50px;
        height: 50px;
    }
    
    .menu-reportes-item p {
        font-size: 12px;
    }
}
</style>

<div class="menu-reportes-container">
    <div class="container">
        <h5 class="text-center">REPORTES</h5>
        
        <div class="menu-reportes-grid">

            <a href="wt_control_caja.php" class="menu-reportes-item">
                <img src="./whatsaap/liquidacion.png" alt="Liquidaciones">
                <p>GASTOS</p>
            </a>
            
            
            <a href="#" class="menu-reportes-item">
                <img src="./whatsaap/liquidacion.png" alt="Liquidaciones">
                <p>LIQUIDACIONES</p>
            </a>
            
            <a href="#" class="menu-reportes-item">
                <img src="./whatsaap/incidencias.png" alt="Incidencias">
                <p>INCIDENCIAS</p>
            </a>
            
            <a href="#" class="menu-reportes-item">
                <img src="./whatsaap/datos.png" alt="Ficha Datos">
                <p>FICHA DATOS</p>
            </a>
        </div>
    </div>
</div>

