# @renolab - RGE

Wrapper pour l'utilisation des Open Data RGE de l'Ademe.

## Installation

```
composer require renolab/rge
```

## Utilisation

```
use Renolab\Rge\DomaineService;
use Renolab\Rge\EntrepriseService;

$domaineService = new DomaineService();
$entrepriseService = new EntrepriseService();

$domaineService->all(); // Liste l'ensemble des domaines RGE
$domaine = $domaineService->find('Pompe à chaleur : chauffage'); // Retourne un domaine RGE

$entrepriseService->find('79056711900025', new \DateTime()); // Retourne une entreprise RGE et ses qualifications en cours
$entrepriseService->search('Pompe à chaleur : chauffage', '84007', 5); // Liste l'ensemble des entreprises RGE dans un rayon donné pour un domaine de travaux 
```

## Sources

- [Liste des entreprises RGE](https://data.ademe.fr/datasets/liste-des-entreprises-rge)
- [Liste des entreprises RGE v2](https://data.ademe.fr/datasets/liste-des-entreprises-rge-2)
- [Historique des entreprises RGE depuis 2014](https://data.ademe.fr/datasets/historique-rge)
- [Article 1 du décret n° 2014-812 du 16 juillet 2014 pris pour l'application du second alinéa du 2 de l'article 200 quater du code général des impôts et du dernier alinéa du 2 du I de l'article 244 quater U du code général des impôts](https://www.legifrance.gouv.fr/loda/article_lc/LEGIARTI000041963293)
