describe("prueba_sistema", () => {
it("tests prueba_sistema", () => {

  // Corrige eventos no detectados por Cypress:
  cy.on("uncaught:exception", (e, runnable) => {
    console.log("error", e);
    console.log("runnable", runnable);
    return false;
    });

  cy.viewport(1486, 846);

  cy.visit("http://localhost:8080/proyecto_sergio/");

  cy.get("#login-box > div > div:nth-child(1) > input[type=text]").click();

  cy.get("#login-box > div > div:nth-child(1) > input[type=text]").type("padmin");

  cy.get("#login-box > div > div:nth-child(3) > input[type=password]").click();

  cy.get("#login-box > div > div:nth-child(3) > input[type=password]").type("admin");

  cy.get("#login-box > button").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/");

  cy.get("#menu > ul > li:nth-child(8) > a > span").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/listar_categorias.php");

  cy.get("#contenido > div > div.d-sm-flex.align-items-center.justify-content-between.mb-4 > a").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_categorias.php");

  cy.get("#nombre").click();

  cy.get("#nombre").type("Frutas");

  cy.get("#contenido > div.row > div > form > input").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_categorias.php");

  cy.get("#menu > ul > li:nth-child(10) > a > span").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/listar_productos.php");

  cy.get("#contenido > div > div.d-sm-flex.align-items-center.justify-content-between.mb-4 > a").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_productos.php");

  cy.get("#codigobarras").click();

  cy.get("#codigobarras").type("7676");

  cy.get("#descripcion").click();

  cy.get("#descripcion").type("Manzana");

  cy.get("#precioventa").click();

  cy.get("#precioventa").type("1500");

  cy.get("#preciocosto").click();

  cy.get("#preciocosto").type("750");

  cy.get("#stock").click();

  cy.get("#stock").type("25");

  cy.get("#idcategoria").select('Frutas'); //Se cambia click por select

  cy.get("#idcategoria").type("6");

  cy.get("#idproveedor").select('Proveedor General'); //Se cambia click por select

  cy.get("#idproveedor").type("9");

  cy.get("#contenido > div.row > div > form > input").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_productos.php");

  cy.get("#menu > ul > li:nth-child(10) > a > span").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/listar_productos.php");

  cy.get("#menu > ul > li:nth-child(7) > a > span").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/listar_cliente.php");

  cy.get("#contenido > div > div.d-sm-flex.align-items-center.justify-content-between.mb-4 > a").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_cliente.php");

  cy.get("#idcliente").click();

  cy.get("#idcliente").type("555");

  cy.get("#nombre").click();

  cy.get("#nombre").type("Polania");

  cy.get("#direccion").click();

  cy.get("#direccion").type("sena");

  cy.get("#telefono").click();

  cy.get("#telefono").type("123");

  cy.get("#email").click();

  cy.get("#email").type("hola@hola.com");

  cy.get("#contenido > div.row > div > form > input").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_cliente.php");

  cy.get("#menu > ul > li:nth-child(5) > a > span").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_venta.php");

  cy.get("#dni_cliente").click();

  cy.get("#dni_cliente").type("555");

  cy.get("#txt_cod_producto").click();

  cy.get("#txt_cod_producto").type("2");

  cy.get("#add_product_venta").click();

  cy.get("#cabecera > div > div:nth-child(2) > div > button > a").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/");

  });
});
//# recorderSourceMap=BCCECGCICKCMCODRDUDXCZCbDeDhBDkBCmBCoBCqBCsBCuBCwBCyBC0BC2BC4BC6BC8BC+BCgCDjCDmCDpCDsCCuCCwCCyCC0CC2CC4CC6CC8CC+CCgDDjDDmDCoDCqDCsDCuDCwDD
