# Slik endrer du innholdet på frontlinepc.no

Alt under gjøres i wp-admin. Du trenger ikke kode, terminal eller hjelp fra en utvikler.

Forsiden er en helt vanlig side som heter **Forside**. Du redigerer den slik du
redigerer en hvilken som helst annen side.

> **Merk:** Forsiden har med vilje ingen «Rediger med Elementor»-knapp. Den er
> bygget av blokker, og Elementor ville overskrevet oppsettet. Alle de andre
> sidene har knappen som før.

---

## Forsiden

| Du vil endre … | Gå til … |
|---|---|
| Overskriften «Velg din klasse. Så tar maskinen resten.» | Sider → Forside → klikk på overskriften |
| «Real Gaming»-merket over overskriften | Sider → Forside → klikk på teksten |
| Ingressen under overskriften | Sider → Forside → klikk på avsnittet |
| Knappene «Se maskinene» og «3 års garanti» | Sider → Forside → klikk på knappen (tekst og lenke) |
| Hovedbildet av PC-en | Sider → Forside → klikk bildet → **Erstatt** |
| Tallene Byggetid / Stresstest / Garanti | Sider → Forside → klikk på tallet eller etiketten |
| Linja «Bygget i Norge», «Fri frakt …», «Levering 3–5 dager» | Sider → Forside → klikk på teksten |
| «Tre prisklasser» og «Fighter. Ghost. Titan.» | Sider → Forside → klikk på teksten |
| Lenka «Sammenlign alle spesifikasjoner» | Sider → Forside → klikk på lenka |
| De fire stegene under «Slik bygger vi» | Sider → Forside → klikk på overskrift eller tekst |
| «Usikker på hvilken klasse?» og «Chat med oss» | Sider → Forside → klikk på teksten |
| Nyhetsbrev-teksten | Sider → Forside → klikk på teksten |
| Rekkefølgen på seksjonene | Sider → Forside → dra seksjonen opp eller ned i listevisningen |
| Fjerne en hel seksjon | Sider → Forside → merk seksjonen → Slett |

> **Tips:** Åpne **Listevisning** (ikonet øverst til venstre i editoren) for å se
> alle seksjonene som en liste. Det er den enkleste måten å flytte på dem.

---

## Toppen og bunnen av siden (gjelder alle sider)

| Du vil endre … | Gå til … |
|---|---|
| Den blå linja øverst: fri frakt / testet i Norge / levering | Utseende → Redigering → Mønstre → Deler av mal → **Header** |
| Logoen | Utseende → Redigering → klikk logoen → Erstatt |
| Menyen | Utseende → Redigering → klikk menyen |
| Søkefeltets tekst | Utseende → Redigering → Deler av mal → **Header** |
| Teksten i bunnen om Frontline PC | Utseende → Redigering → Deler av mal → **Footer** |
| Lenkene under Butikk og Kundeservice | Utseende → Redigering → Deler av mal → **Footer** |
| Betalingsmerkene (Vipps, Klarna, Visa, Mastercard) | Utseende → Redigering → Deler av mal → **Footer** |
| «© 2026 Frontline PC AS» og «Alle priser inkl. mva.» | Utseende → Redigering → Deler av mal → **Footer** |

---

## Produkter og butikk

| Du vil endre … | Gå til … |
|---|---|
| Produktnavn, pris, bilde, beskrivelse | Produkter → velg produktet |
| Spesifikasjonene på produktkortet (Grafikkort, Prosessor …) | Produkter → produktet → fanen **Attributter** |
| Navnet på en spesifikasjonsrad for alle produkter | Produkter → Attributter |
| Hvilke tre maskiner som vises på forsiden | Produkter → merk nøyaktig tre som **Utvalgt** (stjerna) |
| «På lager» / «Utsolgt»-teksten | Utseende → Redigering → Maler → Produkt → klikk merket |
| Teksten «fra … /mnd» | Utseende → Redigering → Maler → Produkt → klikk teksten |
| Rekkefølgen i butikken | Produkter → dra, eller Utseende → Redigering → Maler → Produktarkiv |

---

## Andre sider

| Du vil endre … | Gå til … |
|---|---|
| Om oss, Kontakt, Tjenester, blogginnlegg | Sider → velg siden |
| 404-siden («Denne siden finnes ikke») | Utseende → Redigering → Maler → **404** |
| Teksten når et søk ikke gir treff | Utseende → Redigering → Maler → Søkeresultater |

---

## Dette ligger ikke i temaet

Disse endres et annet sted, ikke i editoren:

| Tekst | Hvor |
|---|---|
| «PAY WITH KLARNA» på kasseknappen | Klarna-utvidelsens innstillinger, eventuelt Loco Translate |
| Spørsmålet om produktomtale i kassen (på engelsk) | WooCommerce → Innstillinger → CusRev → «Customer consent text» |
| «Inkluderer … i avgifter» i kassen | WooCommerce sin egen tekst — Loco Translate. Kildestreng: `Including <TaxAmount/> in taxes`. Skriv «Inkluderer <TaxAmount/> i mva.» — vi sier mva., ikke avgifter |
| «Din handlekurv» øverst i handlekurv-skuffen | Loco Translate → WooCommerce. Kildestreng: `Your cart` |
| «(elementer: 1)» ved siden av den overskriften | Loco Translate → WooCommerce. To kildestrenger: `(%d item)` og `(%d items)`. Skriv «(%d vare)» og «(%d varer)» |
| Priser med eller uten desimaler | WooCommerce → Innstillinger → Generelt |
| Fri frakt-grensen | WooCommerce → Innstillinger → Frakt → Norge |

---

## Hvis noe ser rart ut etter en endring

Angre med **Ctrl + Z** i editoren, eller åpne **Revisjoner** i sidepanelet og
gå tilbake til en tidligere versjon. Ingenting er borte for godt.
