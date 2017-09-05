Imports System.Web.Services
Imports System.Web.Services.Protocols
Imports System.ComponentModel
Imports Objets100Lib

' Pour autoriser l'appel de ce service Web depuis un script à l'aide d'ASP.NET AJAX, supprimez les marques de commentaire de la ligne suivante.
' <System.Web.Script.Services.ScriptService()> _
<System.Web.Services.WebService(Namespace:="http://tempuri.org/")> _
<System.Web.Services.WebServiceBinding(ConformsTo:=WsiProfiles.None)> _
<ToolboxItem(False)> _
<SoapRpcService> _
Public Class Service1


    Inherits System.Web.Services.WebService
    Private Shared BCPTA As New BSCIALApplication3



    <SoapRpcMethod> _
<WebMethod()> _
    Public Function connexion_om() As String
        'Dim BCPTA As New BSCIALApplication3

        Try
            If BCPTA.IsOpen Then
                Return "OK"
            Else

                BCPTA.Name = "C:\wamp\www\sage\bijou.gcm"
                BCPTA.Loggable.UserName = "<Administrateur>"
                BCPTA.Loggable.UserPwd = ""
                BCPTA.Open()
                '   MsgBox("Connexion OK")
                Return "OK"

            End If


        Catch ex As Exception
            '  MsgBox("Erreur :" + ex.Message)
            Return ex.Message




        End Try

    End Function




    'Création document
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function creation_document(num As String, souche As String,type As Integer) As String
        'Type 0 : Devis
        'Type 6 : Facture
        'Type 3 : Bl
        'type 4 : Retour
        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If


            Dim entete As IBODocumentVente3
            Dim client As IBOClient3
            Dim piece As String

            If (type = 0) Then
                entete = BCPTA.FactoryDocumentVente.CreateType(DocumentType.DocumentTypeVenteDevis)
            ElseIf (type = 3) Then
                entete = BCPTA.FactoryDocumentVente.CreateType(DocumentType.DocumentTypeVenteLivraison)
            ElseIf (type = 6) Then
                entete = BCPTA.FactoryDocumentVente.CreateType(DocumentType.DocumentTypeVenteFacture)
            ElseIf (type = 4) Then
                entete = BCPTA.FactoryDocumentVente.CreateFacture(DocumentProvenanceType.DocProvenanceRetour)
            Else
                    entete =nothing
            End If
            client = BCPTA.CptaApplication.FactoryClient.ReadNumero(num)
            entete.SetDefaultClient(client)
            entete.Souche = BCPTA.FactorySoucheVente.ReadIntitule(souche)
            entete.SetDefaultDO_Piece()
            entete.SetDefault()
            entete.CouldModified()
            entete.Write()
            piece = entete.DO_Piece
            Return piece

        Catch ex As Exception
            Return ex.Message
        End Try

    End Function


    'Ligne Document
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function ligne_document(num As String, type As Integer, article As String, qte As Double) As String
        ' Dim basecial As New BSCIALApplication3
        'Type 0 : Devis
        'Type 6 : Facture
        'Type 3 : Bl
        'type 4 : Retour

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If



            Dim entete As IBODocumentVente3
            Dim art As IBOArticle3
            Dim ligne As IBODocumentVenteLigne3


            art = BCPTA.FactoryArticle.ReadReference(article)

            If (type = 0) Then
                entete = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteDevis, num)
            ElseIf (type = 3) Then
                entete = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteLivraison, num)
            ElseIf (type = 6) Then
                entete = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteFacture, num)
            ElseIf (type = 4) Then
                entete = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteFacture, num)
                qte = qte * -1
            Else
                entete = Nothing
            End If


            entete.CouldModified()

            ligne = entete.FactoryDocumentLigne.Create()
            ligne.SetDefaultArticle(art, qte)
            ligne.Write()

            Return "OK"


        Catch ex As Exception
            '  MsgBox("Erreur :" + ex.Message)
            Return ex.Message


        End Try

    End Function



    'Suppression Ligne Document
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function suppression_ligne(num As String, Type As Integer, item As Integer) As String
        '        Dim basecial As New BSCIALApplication3

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If

            Dim DOC_ORIG As IBODocumentVente3


            If (Type = 0) Then
                DOC_ORIG = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteDevis, num)
            ElseIf (Type = 3) Then
                DOC_ORIG = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteLivraison, num)
            ElseIf (Type = 6) Then
                DOC_ORIG = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteFacture, num)
            ElseIf (Type = 4) Then
                DOC_ORIG = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteFacture, num)
            Else
                DOC_ORIG = Nothing
            End If



            DOC_ORIG.FactoryDocumentLigne.List.Item(item).Remove()



            Return "OK"




        Catch ex As Exception
            '  MsgBox("Erreur :" + ex.Message)
            Return ex.Message


        End Try

    End Function




    'Création Client
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function creation_client(num As String, intitule As String, compteg As String, adresse As String, ville As String, telephone As String,
                                    email As String) As String

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If


            Dim client As IBOClient3



            If Not BCPTA.CptaApplication.FactoryClient.ExistNumero(num) Then
                client = BCPTA.CptaApplication.FactoryClient.Create
                With client
                    .CT_Num = num
                    .CT_Intitule = intitule
                    .Adresse.Adresse = adresse
                    .Adresse.Ville = ville
                    .Telecom.Telephone = telephone
                    .Telecom.EMail = email
                    .CompteGPrinc = BCPTA.CptaApplication.FactoryCompteG.ReadNumero(compteg)
                    .SetDefault()
                    .Write()
                End With
            End If

            Return "Client Crée avec succès !"

        Catch ex As Exception
            Return ex.Message
        End Try

    End Function






    'Création Devis
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function creation_facture(num As String, souche As String) As String

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If


            Dim entete As IBODocumentVente3
            Dim client As IBOClient3
            Dim piece As String

            entete = BCPTA.FactoryDocumentVente.CreateType(DocumentType.DocumentTypeVenteFacture)
            client = BCPTA.CptaApplication.FactoryClient.ReadNumero(num)
            entete.SetDefaultClient(client)
            entete.Souche = BCPTA.FactorySoucheVente.ReadIntitule(souche)
            entete.SetDefaultDO_Piece()
            entete.SetDefault()
            entete.CouldModified()
            entete.Write()
            piece = entete.DO_Piece
            Return piece

        Catch ex As Exception
            Return ex.Message
        End Try

    End Function




    'Création Devis
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function creation_devis(num As String, souche As String) As String

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If


            Dim entete As IBODocumentVente3
            Dim client As IBOClient3
            Dim piece As String

            entete = BCPTA.FactoryDocumentVente.CreateType(DocumentType.DocumentTypeVenteDevis)
            client = BCPTA.CptaApplication.FactoryClient.ReadNumero(num)
            entete.SetDefaultClient(client)
            entete.Souche = BCPTA.FactorySoucheVente.ReadIntitule(souche)
            entete.SetDefaultDO_Piece()
            entete.SetDefault()
            entete.CouldModified()
            entete.Write()
            piece = entete.DO_Piece
            Return piece

        Catch ex As Exception
            Return ex.Message
        End Try

    End Function



    'Validation Devis
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function validation_devis(num As String) As String

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If

            Dim entete As IBODocumentVente3

            entete = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteDevis, num)
            'entete.CouldModified()
            entete.DO_Statut = DocumentStatutType.DocumentStatutTypeAPrepare
            entete.Write()



            Return "OK"
        Catch ex As Exception
            Return ex.Message
        End Try

    End Function







    'Ligne Devis
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function ligne_devis(num As String, article As String, qte As Double) As String
        ' Dim basecial As New BSCIALApplication3

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If



            Dim entete As IBODocumentVente3
            Dim art As IBOArticle3
            Dim ligne As IBODocumentVenteLigne3


            art = BCPTA.FactoryArticle.ReadReference(article)

            entete = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteDevis, num)
            entete.CouldModified()

            ligne = entete.FactoryDocumentLigne.Create()
            ligne.SetDefaultArticle(art, qte)
            ligne.Write()

            Return "OK"


        Catch ex As Exception
            '  MsgBox("Erreur :" + ex.Message)
            Return ex.Message


        End Try

    End Function


    'Création BL
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function creation_bl(num As String, souche As String) As String

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If




            Dim entete As IBODocumentVente3
            Dim client As IBOClient3
            Dim piece As String

            entete = BCPTA.FactoryDocumentVente.CreateType(DocumentType.DocumentTypeVenteLivraison)
            client = BCPTA.CptaApplication.FactoryClient.ReadNumero(num)
            entete.SetDefaultClient(client)
            entete.Souche = BCPTA.FactorySoucheVente.ReadIntitule(souche)
            entete.SetDefaultDO_Piece()
            entete.SetDefault()
            entete.Write()
            'entete.CouldModified()

            piece = entete.DO_Piece


            Return piece


        Catch ex As Exception
            '  MsgBox("Erreur :" + ex.Message)
            Return ex.Message


        End Try

    End Function


    'Transformation Ligne
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function transformation_ligne(bl As String, devis As String, item As Integer) As String
        '        Dim basecial As New BSCIALApplication3

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If


            Dim DOC_ORIG1 As IBODocumentVente3
            Dim DOC_FINAL As IBODocumentVente3
            Dim X As IBODocumentLigne3
            Dim PROC_TRANS As IPMDocTransformer



            DOC_ORIG1 = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteDevis, devis)
            DOC_ORIG1.Refresh()
            'DOC_ORIG1.CouldModified()

            ' X = DOC_ORIG1.FactoryDocumentLigne.List(item)
            DOC_FINAL = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteLivraison, bl)
            PROC_TRANS = BCPTA.Transformation.Vente.CreateProcess_Livrer
            PROC_TRANS.AddDocument(DOC_ORIG1)

            PROC_TRANS.AddDocumentDestination(DOC_FINAL)
            'PROC_TRANS.AddDocumentLigne(X)

            If PROC_TRANS.CanProcess Then
                PROC_TRANS.Process()

            End If
            Return "OK"


            ' DOC_ORIG1 = basecial.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteDevis, devis)
            'DOC_ORIG1.CouldModified()
            'X = DOC_ORIG1.FactoryDocumentLigne.List.Item(item)
            'PROC_TRANS = basecial.Transformation.Vente.CreateProcess_Livrer
            'DOC_FINAL.CouldModified()
            'PROC_TRANS.AddDocumentDestination(DOC_FINAL)


            '            PROC_TRANS.AddDocumentLigne(X)


            'If PROC_TRANS.CanProcess Then
            'PROC_TRANS.Process()
            'Return "Doc Transformé"
            'Else
            'Return PROC_TRANS.Errors.Item(1).Text
            'End If



        Catch ex As Exception
            '  MsgBox("Erreur :" + ex.Message)
            Return ex.Message


        End Try

    End Function


    'Transformation Ligne
    <SoapRpcMethod> _
<WebMethod()> _
    Public Function transformation_bl_facture(bl As String, facture As String) As String
        '        Dim basecial As New BSCIALApplication3

        Try
            If Not BCPTA.IsOpen Then
                connexion_om()
            End If


            Dim DOC_ORIG1 As IBODocumentVente3
            Dim DOC_FINAL As IBODocumentVente3
            Dim PROC_TRANS As IPMDocTransformer



            DOC_ORIG1 = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteLivraison, bl)

            DOC_FINAL = BCPTA.FactoryDocumentVente.ReadPiece(DocumentType.DocumentTypeVenteFacture, facture)
            PROC_TRANS = BCPTA.Transformation.Vente.CreateProcess_Facturer
            PROC_TRANS.AddDocument(DOC_ORIG1)


            PROC_TRANS.AddDocumentDestination(DOC_FINAL)

            If PROC_TRANS.CanProcess Then
                PROC_TRANS.Process()
            End If
            Return "OK"



        Catch ex As Exception
            '  MsgBox("Erreur :" + ex.Message)
            Return ex.Message


        End Try

    End Function


End Class